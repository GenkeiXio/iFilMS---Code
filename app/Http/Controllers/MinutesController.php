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

class MinutesController extends Controller
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

        // Meeting type labels for mapping
        $map = [
            'academic'       => 'Academic Council Meeting',
            'administrative' => 'Administrative Council Meeting',
            'board'          => 'Board Meeting',
        ];

        // Document counts per meeting type
        $academicCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['academic'])
            ->count();

        $administrativeCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['administrative'])
            ->count();

        $boardCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['board'])
            ->count();

        // Last uploads & statuses
        $lastUploads = [];
        $statuses = [];

        foreach ($map as $key => $label) {
            $last = Document::where('category', 'Minutes')
                ->where('meeting_type', $label)
                ->latest('upload_date')
                ->value('upload_date');

            // Store upload date (formatted as Y-m-d H:i:s)
            $lastUploads[$key] = $last ? Carbon::parse($last)->toDateTimeString() : null;

            // Determine if Active or Inactive (30 days rule)
            if ($last) {
                $lastDate = Carbon::parse($last);
                $statuses[$key] = $lastDate->greaterThanOrEqualTo(Carbon::now()->subDays(30))
                    ? 'Active'
                    : 'Inactive';
            } else {
                $statuses[$key] = 'Inactive';
            }
        }

        // Return everything to the view
        return view('minutes.index', compact(
            'academicCount',
            'administrativeCount',
            'boardCount',
            'lastUploads',
            'statuses'
        ));
    }

    public function list(string $category, Request $request)
    {

        // URL → meeting_type mapping
        $map = [
            'academic-council'       => 'Academic Council Meeting',
            'administrative-council' => 'Administrative Council Meeting',
            'board-meetings'         => 'Board Meeting',
        ];

        abort_unless(isset($map[$category]), 404);

        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $sort    = $request->get('sort', 'date');

        // Base query
        $query = Document::with(['staff', 'metadataTags'])
            ->where('category', 'Minutes')
            ->where('meeting_type', $map[$category]);

        // 🔍 Search by title or tags
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('metadataTags', function ($tagQuery) use ($search) {
                      $tagQuery->where('value', 'like', "%{$search}%");
                  });
            });
        }

        // 🔽 Sort by name or upload date
        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('upload_date', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('minutes.list', [
            'title'     => $map[$category],
            'documents' => $documents,
        ]);
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




