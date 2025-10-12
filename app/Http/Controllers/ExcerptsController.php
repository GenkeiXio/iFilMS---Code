<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;

class ExcerptsController extends Controller
{
    public function index()
    {
        // Only one meeting type for Excerpts
        $meetingType = 'Board Meeting';

        // Count total excerpts for Board Meeting
        $boardCount = Document::where('category', 'Excerpts')
            ->where('meeting_type', $meetingType)
            ->count();

        // Get last upload date
        $lastUpload = Document::where('category', 'Excerpts')
            ->where('meeting_type', $meetingType)
            ->latest('upload_date')
            ->value('upload_date');

        // Format last upload or set default
        $lastUpload = $lastUpload ? Carbon::parse($lastUpload)->toDateTimeString() : '—';

        // Determine Active/Inactive based on last upload within 30 days
        $status = ($lastUpload !== '—' && Carbon::parse($lastUpload)->greaterThanOrEqualTo(Carbon::now()->subDays(30)))
            ? 'Active'
            : 'Inactive';

        return view('excerpts.index', compact('boardCount', 'lastUpload', 'status'));
    }

    public function list(Request $request)
    {
        $title = 'Board Meeting Excerpts';

        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $sort    = $request->get('sort', 'date');

        // Query only Excerpts → Board Meeting
        $query = Document::with(['staff', 'metadataTags'])
            ->where('category', 'Excerpts')
            ->where('meeting_type', 'Board Meeting');

        // 🔍 Search by title or tags
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

        return view('excerpts.list', compact('title', 'documents'));
    }
}
