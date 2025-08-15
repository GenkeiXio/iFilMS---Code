<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranscriptionController extends Controller
{
    public function index()
    {
        // Landing page with 3 cards (Academic/Administrative/Board)
        return view('transcriptions.index');
    }

    public function list(string $category)
    {
        // Normalize readable titles for the header
        $map = [
            'academic-council' => 'Academic Council Meetings',
            'administrative-council' => 'Administrative Council Meetings',
            'board-meetings' => 'Board Meetings',
        ];
        abort_unless(isset($map[$category]), 404);

        return view('transcriptions.list', [
            'category' => $category,
            'title'    => $map[$category],
            // you can pass $documents later when you hook up DB
            'documents' => [],
        ]);
    }

    public function upload(Request $request, string $category)
    {
        // For now, just bounce back with a flash message (hook backend later)
        return back()->with('success', 'Upload endpoint hit (wire backend next).');
    }
}
