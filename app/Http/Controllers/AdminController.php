<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        // Totals
        $totalDocuments = Document::count();

        // Documents uploaded this month
        $thisMonth = Document::whereMonth('upload_date', Carbon::now()->month)
            ->whereYear('upload_date', Carbon::now()->year)
            ->count();

        // Categories (unique categories in documents table)
        $categories = Document::distinct('category')->count('category');

        // Active users (staff who uploaded at least 1 document)
        $activeUsers = Document::distinct('staff_id')->count('staff_id');

        // --- Get uploads
        $uploads = DB::table('documents')
            ->join('staff', 'documents.staff_id', '=', 'staff.staff_id')
            ->select('staff.name', 'documents.title', 'documents.upload_date as date', DB::raw("'uploaded' as action"))
            ->whereNull('documents.deleted_at');

        // --- Get downloads
        $downloads = DB::table('retrieval')
            ->join('documents', 'retrieval.document_id', '=', 'documents.document_id')
            ->join('staff', 'retrieval.staff_id', '=', 'staff.staff_id')
            ->select('staff.name', 'documents.title', 'retrieval.retrieval_date as date', DB::raw("'downloaded' as action"));

        // --- Get restores
        $restores = DB::table('documents')
            ->join('staff', 'documents.restored_by', '=', 'staff.staff_id')
            ->select('staff.name', 'documents.title', 'documents.restored_at as date', DB::raw("'restored' as action"))
            ->whereNotNull('documents.restored_at');

        // --- Get deletions
        $deletions = DB::table('storage')
            ->join('documents', 'storage.document_id', '=', 'documents.document_id')
            ->join('staff', 'storage.staff_id', '=', 'staff.staff_id')
            ->select('staff.name', 'documents.title', 'storage.storage_date as date', DB::raw("'deleted' as action"));

        // Merge all logs
        $recentActivity = $uploads
            ->unionAll($downloads)
            ->unionAll($deletions)
            ->unionAll($restores)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();


        // Staff name
        $staffName = auth('staff')->user()->name ?? 'Staff';

        // Read logs.txt (stored in storage/logs/logs.txt)
        $logFilePath = storage_path('logs/logs.txt');
        $logs = [];

        if (File::exists($logFilePath)) {
            $logLines = array_reverse(file($logFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
            $logs = array_slice($logLines, 0, 100); // Show only last 15 entries
        }

        return view('admin.admindashboard', compact(
            'totalDocuments',
            'thisMonth',
            'categories',
            'activeUsers',
            'recentActivity',
            'staffName',
            'logs'
        ));
    }
}
