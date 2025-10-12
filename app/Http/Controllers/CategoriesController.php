<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = [
            'transcriptions'          => 'Transcriptions',
            'minutes'                 => 'Minutes',
            'excerpts'                => 'Excerpts',
            'secretary_certification' => "Secretary's Certification",
            'referendum'              => 'Referendum',
            'board_resolution'        => 'Board Resolution',
        ];

        $counts = [];
        $lastUploads = [];
        $statuses = [];

        foreach ($categories as $key => $name) {
            // Total count
            $counts[$key] = Document::where('category', $name)->count();

            // Last upload date
            $lastUploads[$key] = Document::where('category', $name)
                ->orderBy('upload_date', 'desc')
                ->value('upload_date');

            // Status logic (active if uploaded in the last 30 days)
            if ($lastUploads[$key]) {
                $lastDate = Carbon::parse($lastUploads[$key]);
                $statuses[$key] = $lastDate->greaterThanOrEqualTo(Carbon::now()->subDays(30)) 
                    ? 'Active' 
                    : 'Inactive';
            } else {
                $statuses[$key] = 'Inactive';
            }
        }

        return view('MainSideBar.categories', compact('counts', 'lastUploads', 'statuses'));
    }
}
