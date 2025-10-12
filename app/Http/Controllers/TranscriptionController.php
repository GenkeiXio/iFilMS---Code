<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Carbon\Carbon;

class TranscriptionController extends Controller
{
    public function index()
    {
        // map keys used by the blade: academic, administrative, board
        $map = [
            'academic'       => 'Academic Council Meeting',
            'administrative' => 'Administrative Council Meeting',
            'board'          => 'Board Meeting',
        ];

        // counts (separate variables so your blade can keep using $academicCount etc)
        $academicCount = Document::where('category', 'Transcriptions')
            ->where('meeting_type', $map['academic'])
            ->count();

        $administrativeCount = Document::where('category', 'Transcriptions')
            ->where('meeting_type', $map['administrative'])
            ->count();

        $boardCount = Document::where('category', 'Transcriptions')
            ->where('meeting_type', $map['board'])
            ->count();

        // last upload timestamps and status per sub-folder
        $lastUploads = [];
        $statuses = [];

        foreach ($map as $key => $label) {
            $last = Document::where('category', 'Transcriptions')
                ->where('meeting_type', $label)
                ->latest('upload_date')
                ->value('upload_date');

            // keep raw timestamp string (or null) — blade shows directly
            $lastUploads[$key] = $last ? Carbon::parse($last)->toDateTimeString() : null;

            if ($last) {
                $lastDate = Carbon::parse($last);
                // Active if last upload within 30 days
                $statuses[$key] = $lastDate->greaterThanOrEqualTo(Carbon::now()->subDays(30)) ? 'Active' : 'Inactive';
            } else {
                $statuses[$key] = 'Inactive';
            }
        }

        return view('transcriptions.index', compact(
            'academicCount',
            'administrativeCount',
            'boardCount',
            'lastUploads',
            'statuses'
        ));
    }

    public function list(string $category)
    {
        $map = [
            'academic-council'       => 'Academic Council Meeting',
            'administrative-council' => 'Administrative Council Meeting',
            'board-meetings'         => 'Board Meeting',
        ];

        abort_unless(isset($map[$category]), 404);

        $perPage = request('per_page', 10);
        $search  = request('search');
        $sort    = request('sort', 'date');

        $query = Document::where('category', 'Transcriptions')
            ->where('meeting_type', $map[$category])
            ->with('staff', 'metadataTags');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('metadataTags', function ($q2) use ($search) {
                      $q2->where('value', 'like', "%{$search}%");
                  });
            });
        }

        if ($sort === 'name') {
            $query->orderBy('title', 'asc');
        } else {
            $query->orderBy('upload_date', 'desc');
        }

        $documents = $query->paginate($perPage);

        return view('transcriptions.list', [
            'title'     => $map[$category],
            'documents' => $documents,
        ]);
    }
}
