<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;

class MinutesController extends Controller
{
    public function index()
    {
        // Meeting type labels for mapping
        $map = [
            'academic'       => 'Academic Council Meeting',
            'administrative' => 'Administrative Council Meeting',
            'board'          => 'Board Meeting',
        ];

        // Document counts per meeting type
        $academicCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['academic'])
            ->count();

        $administrativeCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['administrative'])
            ->count();

        $boardCount = Document::where('category', 'Minutes')
            ->where('meeting_type', $map['board'])
            ->count();

        // Last uploads & statuses
        $lastUploads = [];
        $statuses = [];

        foreach ($map as $key => $label) {
            $last = Document::where('category', 'Minutes')
                ->where('meeting_type', $label)
                ->latest('upload_date')
                ->value('upload_date');

            // Store upload date (formatted as Y-m-d H:i:s)
            $lastUploads[$key] = $last ? Carbon::parse($last)->toDateTimeString() : null;

            // Determine if Active or Inactive (30 days rule)
            if ($last) {
                $lastDate = Carbon::parse($last);
                $statuses[$key] = $lastDate->greaterThanOrEqualTo(Carbon::now()->subDays(30))
                    ? 'Active'
                    : 'Inactive';
            } else {
                $statuses[$key] = 'Inactive';
            }
        }

        // Return everything to the view
        return view('minutes.index', compact(
            'academicCount',
            'administrativeCount',
            'boardCount',
            'lastUploads',
            'statuses'
        ));
    }

    public function list(string $category, Request $request)
    {
        // URL → meeting_type mapping
        $map = [
            'academic-council'       => 'Academic Council Meeting',
            'administrative-council' => 'Administrative Council Meeting',
            'board-meetings'         => 'Board Meeting',
        ];

        abort_unless(isset($map[$category]), 404);

        $perPage = $request->get('per_page', 10);
        $search  = $request->get('search');
        $sort    = $request->get('sort', 'date');

        // Base query
        $query = Document::with(['staff', 'metadataTags'])
            ->where('category', 'Minutes')
            ->where('meeting_type', $map[$category]);

        // 🔍 Search by title or tags
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('metadataTags', function ($tagQuery) use ($search) {
                      $tagQuery->where('value', 'like', "%{$search}%");
                  });
            });
        }

        // 🔽 Sort by name or upload date
        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('upload_date', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('minutes.list', [
            'title'     => $map[$category],
            'documents' => $documents,
        ]);
    }
}




