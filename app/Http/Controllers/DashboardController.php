<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Staff;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total documents
        $totalDocuments = Document::count();

        // Documents uploaded this month
        $thisMonth = Document::whereMonth('upload_date', Carbon::now()->month)
            ->whereYear('upload_date', Carbon::now()->year)
            ->count();

        // Categories (unique categories in documents table)
        $categories = Document::distinct('category')->count('category');

        // Active users (staff who uploaded at least 1 document)
        $activeUsers = Document::distinct('staff_id')->count('staff_id');

        // Recent activity (last 5 uploaded documents)
        $recentActivity = Document::orderBy('upload_date', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalDocuments',
            'thisMonth',
            'categories',
            'activeUsers',
            'recentActivity'
        ));
    }
}
