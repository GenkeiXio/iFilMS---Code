<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\MetadataTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage as FileStorage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        // HARD SECURITY — blocks direct POST
        if (!auth('staff')->user()->hasPermission('upload')) {
            abort(403, 'You do not have permission to upload documents.');
        }

        // Validate
        $request->validate([
            'file'        => 'required|mimes:pdf,doc,docx,txt,csv,xlsx,jpg,jpeg,png|max:1048576',
            'title'       => 'nullable|string|max:255', // now optional (auto-generated)
            'category'    => 'nullable|string',
            'meeting_type'=> 'nullable|string',
            'tags'        => 'nullable|string', 
        ]);

        $file = $request->file('file');
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        // Auto-title if empty
        $title = $request->title ?: Str::title(str_replace(['_', '-'], ' ', $originalName));

        // Auto-detect category
        $detectedCategory = $this->detectCategory($originalName);

        // Auto-detect meeting type
        $detectedMeetingType = $this->detectMeetingType($originalName);

        // Use detected values only if user didn’t pick one
        $category = $request->category ?: $detectedCategory;
        $meetingType = $request->meeting_type ?: $detectedMeetingType;

        // Save file
        $filename = uniqid() . '.' . $extension;
        $filePath = 'documents/' . $filename;

        // Read original file contents
        $fileContents = file_get_contents($file->getRealPath());

        // Encrypt file contents
        $encryptedContents = Crypt::encryptString($fileContents);

        // Store encrypted file in PRIVATE storage
        Storage::disk('local')->put($filePath, $encryptedContents);
        
        // Save document
        $document = Document::create([
            'title'        => $title,
            'staff_id'     => Auth::id(),
            'file_path'    => $filePath,
            'file_type'    => $extension,
            'uploaded_by'  => Auth::id(),
            'category'     => $category,
            'meeting_type' => $meetingType,
            'upload_date'  => Carbon::now(),
        ]);

        // Auto-generate tags from filename
        $autoTags = $this->generateTagsFromFilename($originalName);

        // Merge with manually provided tags
        if (!empty($request->tags)) {
            $manualTags = array_map('trim', explode(',', $request->tags));
            $autoTags = array_unique(array_merge($autoTags, $manualTags));
        }

        // Save tags
        foreach ($autoTags as $tag) {
            if (!empty($tag)) {
                $document->metadataTags()->create([
                    'tag'   => $tag,
                    'value' => $tag,
                ]);
            }
        }

        return redirect()->route('mainsidebar.documents')
            ->with('success', 'Document uploaded successfully with auto-title, tags, and category detection!');
    }

    public function create()
    {
        $user = auth('staff')->user();

        // Permission check 
        if (!$user->hasPermission('upload')) {
            return view('MainSideBar.upload', [
                'noUploadPermission' => true
            ]);
        }

        return view('MainSideBar.upload');
    }
    

    private function detectCategory($filename)
    {
        $name = strtolower($filename);
        return match (true) {
            str_contains($name, 'transcription') => 'Transcriptions',
            str_contains($name, 'minute') => 'Minutes',
            str_contains($name, 'excerpt') => 'Excerpts',
            str_contains($name, 'certification') => "Secretary's Certification",
            str_contains($name, 'referendum') => 'Referendum',
            str_contains($name, 'resolution') => 'Board Resolution',
            default => null,
        };
    }


    private function detectMeetingType($filename)
    {
        $name = strtolower($filename);
        return match (true) {
            str_contains($name, 'academic') => 'Academic Council Meeting',
            str_contains($name, 'administrative') => 'Administrative Council Meeting',
            str_contains($name, 'board') => 'Board Meeting',
            default => null,
        };
    }

    private function generateTagsFromFilename($filename)
    {
        $clean = str_replace(['_', '-', '.', '(', ')'], ' ', strtolower($filename));
        $words = preg_split('/\s+/', $clean);
        return array_filter(array_unique($words), fn($w) => strlen($w) > 2);
    }

    private function denyIfNoUploadPermission()
    {
        if (!auth('staff')->user()->hasPermission('upload')) {
            abort(403, 'You do not have permission to upload documents.');
        }
    }
}
