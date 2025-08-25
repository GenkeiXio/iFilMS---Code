<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BoardResolutionController extends Controller
{
    public function index()
    {
        return view('Board-Resolution.index', [
            'title'     => "Board Resolution",
            'documents' => [] // Later replace with DB query
        ]);
    }

    public function upload(Request $request)
    {
        // File upload logic will go here later
        return back()->with('success', 'File uploaded successfully to Board Resolution.');
    }
}
