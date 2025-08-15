<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferendumController extends Controller
{
    public function index()
    {
        return view('Referendum.index', [
            'title'     => "Referendum",
            'documents' => [] // Later replace with DB query
        ]);
    }

    public function upload(Request $request)
    {
        // File upload logic will go here later
        return back()->with('success', 'File uploaded successfully to Referendum.');
    }
}
