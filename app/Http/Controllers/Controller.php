<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function logActivity($action, $title)
    {
        $staff = Auth::user()->name ?? 'Unknown';
        $date = now()->format('Y-m-d H:i:s');

        $logEntry = "[$date] Staff: $staff | Action: $action | Document: $title" . PHP_EOL;

        File::append(storage_path('logs/activity_log.txt'), $logEntry);
    }
}