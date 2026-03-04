<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Retrieval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RecycleBinController extends Controller
{
    public function index(Request $request)
    {
        $perPage   = $request->get('per_page', 10);
        $search    = $request->get('search');
        $sort      = $request->get('sort', 'date');
        $category  = $request->get('category');
        $meeting   = $request->get('meeting_type');

        $query = Document::onlyTrashed()->with(['staff', 'deletedByStaff']);

        if (!empty($search)) {
            $query->where('title', 'like', "%{$search}%");
        }

        if (!empty($category) && $category !== 'all') {
            $query->where('category', $category);
        }

        if (!empty($meeting) && $meeting !== 'all') {
            $query->where('meeting_type', $meeting);
        }

        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('deleted_at', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('MainSideBar.recycle-bin', compact('documents'));
    }

    // ♻️ Restore document
    public function restore($id)
    {
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->restore();

        // Restored_at and restored_by columns being updated here
        $document->restored_at = now();
        $document->restored_by = Auth::id();
        $document->save();

        return redirect()->back()->with('success', 'Document restored successfully.');
    }

    // 🧹 Permanently delete document
    public function destroy($id)
    {
        $document = Document::onlyTrashed()->findOrFail($id);
        $document->forceDelete();

        return redirect()->back()->with('success', 'Document permanently deleted.');
    }
}
