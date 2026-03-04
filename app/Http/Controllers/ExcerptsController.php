<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\LengthAwarePaginator;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcerptsController extends Controller
{
    //PERMISSION GUARD
    private function denyIfNoPermission($permission)
    {
        if (!auth('staff')->user()->hasPermission($permission)) {
            abort(403, 'You do not have permission to perform this action.');
        }
    }

    public function index()
    {
        $user = auth('staff')->user();
        
        // 🚫 Staff with ZERO permissions
        if (
            !$user->canView() &&
            !$user->canDownload() &&
            !$user->canDelete()
        ) {
            return view('MainSideBar.documents', [
                'documents' => new LengthAwarePaginator([], 0, 10),
                'noPermission' => true
            ]);
        }

        // Only one meeting type for Excerpts
        $meetingType = 'Board Meeting';

        // Count total excerpts for Board Meeting
        $boardCount = Document::where('category', 'Excerpts')
            ->where('meeting_type', $meetingType)
            ->count();

        // Get last upload date
        $lastUpload = Document::where('category', 'Excerpts')
            ->where('meeting_type', $meetingType)
            ->latest('upload_date')
            ->value('upload_date');

        // Format last upload or set default
        $lastUpload = $lastUpload ? Carbon::parse($lastUpload)->toDateTimeString() : '—';

        // Determine Active/Inactive based on last upload within 30 days
        $status = ($lastUpload !== '—' && Carbon::parse($lastUpload)->greaterThanOrEqualTo(Carbon::now()->subDays(30)))
            ? 'Active'
            : 'Inactive';

        return view('excerpts.index', compact('boardCount', 'lastUpload', 'status'));
    }

    public function list(Request $request)
    {


        $title = 'Board Meeting Excerpts';

        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $sort    = $request->get('sort', 'date');

        // Query only Excerpts → Board Meeting
        $query = Document::with(['staff', 'metadataTags'])
            ->where('category', 'Excerpts')
            ->where('meeting_type', 'Board Meeting');

        // 🔍 Search by title or tags
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('metadataTags', function ($tagQuery) use ($search) {
                      $tagQuery->where('value', 'like', "%{$search}%");
                  });
            });
        }

        // 🔽 Sort
        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('upload_date', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('excerpts.list', compact('title', 'documents'));
    }

    public function softDelete($id)
    {
        $this->denyIfNoPermission('delete');

        $document = Document::findOrFail($id);
        $document->deleted_by = Auth::id();
        $document->deleted_at = now();
        $document->save();

        // Log delete action to storage table
        DB::table('storage')->insert([
            'document_id' => $document->document_id,
            'staff_id' => Auth::id(),
            'storage_date' => now(),
        ]);

        return redirect()->back()->with('success', 'Document moved to Recycle Bin successfully.');
    }

    // Download Document
    public function download($id)
    {
        $this->denyIfNoPermission('download'); 

        $document = Document::findOrFail($id);

        // IMPORTANT: file_path should be like "documents/filename.pdf"
        if (!Storage::disk('local')->exists($document->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Get encrypted content
        $encrypted = Storage::disk('local')->get($document->file_path);
        
        // Decrypt content
        $decrypted = Crypt::decryptString($encrypted);


        // Log download to retrieval table
        DB::table('retrieval')->insert([
            'document_id' => $document->document_id,
            'staff_id' => Auth::id(),
            'retrieval_date' => now(),
        ]);

        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
        $safeTitle = preg_replace('/[<>:"\/\\|?*]/', '', $document->title);
        $fileName = trim($safeTitle) . '.' . $extension;

        return response()->streamDownload(function () use ($decrypted) {
            echo $decrypted;
        }, $fileName);
    }

    // View Document Inline
    public function view($id)
    {
        $this->denyIfNoPermission('view');
        
        $document = Document::findOrFail($id);

        if (!Storage::disk('local')->exists($document->file_path)) {
            return response()->json(['error' => 'File not found.'], 404);
        }

        // Get encrypted content
        $encrypted = Storage::disk('local')->get($document->file_path);

        // Decrypt content
        $decrypted = Crypt::decryptString($encrypted);

        // Get file contents and MIME type
        $file = Storage::disk('local')->get($document->file_path);
        $mime = Storage::disk('local')->mimeType($document->file_path);


        return response($decrypted, 200)->header('Content-Type', $mime);
    }
}
