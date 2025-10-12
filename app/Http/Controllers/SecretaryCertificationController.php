<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class SecretaryCertificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $sort    = $request->get('sort', 'date');

        // Base query
        $query = Document::with(['staff','metadataTags'])
            ->where('category', "Secretary's Certification");

        // 🔍 Search
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

        return view('secretary-certification.index', [
            'title'     => "Secretary's Certification",
            'documents' => $documents,
        ]);
    }
}