<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinutesController extends Controller
{
    public function index()
    {
        return view('minutes.index');
    }

    public function list(string $category)
    {
        $map = [
            'academic-council' => 'Academic Council Meeting Minutes',
            'administrative-council' => 'Administrative Council Meeting Minutes',
            'board-meetings' => 'Board Meeting Minutes',
        ];
        abort_unless(isset($map[$category]), 404);

        return view('minutes.list', [
            'category' => $category,
            'title'    => $map[$category],
            'documents' => [],
        ]);
    }

    public function upload(Request $request, string $category)
    {
        return back()->with('success', 'Upload endpoint hit for Minutes (backend next).');
    }
}
