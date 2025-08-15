<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecretaryCertificationController extends Controller
{
    public function index()
    {
        return view('secretary-certification.index', [
            'title'     => "Secretary's Certification",
            'documents' => [] // Later will fetch from DB
        ]);
    }

    public function upload(Request $request)
    {
        // File upload logic will go here later
        return back()->with('success', 'File uploaded successfully to Secretary’s Certification.');
    }
}
