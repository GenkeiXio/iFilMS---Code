<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $perPage   = $request->get('per_page', 10);
        $search    = $request->get('search');
        $sort      = $request->get('sort', 'date');
        $category  = $request->get('category');     // filter by category
        $meeting   = $request->get('meeting_type'); // filter by meeting type

        $query = Document::with('staff', 'metadataTags');

        // 🔍 Search
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('metadataTags', function ($tagQuery) use ($search) {
                      $tagQuery->where('value', 'like', "%{$search}%");
                  });
            });
        }

        // 📂 Category filter
        if (!empty($category) && $category !== 'all') {
            $query->where('category', $category);
        }

        // 🏛 Meeting type filter
        if (!empty($meeting) && $meeting !== 'all') {
            $query->where('meeting_type', $meeting);
        }

        // 🔽 Sorting
        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('upload_date', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('MainSideBar.documents', compact('documents'));
    }
}
