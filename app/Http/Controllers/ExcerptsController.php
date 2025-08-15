<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcerptsController extends Controller
{
    public function index()
    {
        return view('excerpts.index');
    }

    public function list()
    {
        $title = 'Board Meeting Excerpts';
        $category = 'board-meetings';
        $documents = []; // Replace later with DB query

        return view('excerpts.list', compact('title', 'category', 'documents'));
    }

    public function upload(Request $request)
    {
        // Handle file saving later
        return back()->with('success', 'Upload endpoint hit for Excerpts.');
    }
}
