<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Staff;
use Carbon\Carbon;

class StaffAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('Authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $staff = Staff::where('username', $request->username)->first();

        // ❌ Invalid credentials
        if (!$staff || !Hash::check($request->password, $staff->password)) {
            return back()->with([
                'access_denied' => true,
                'message' => 'Access denied. Invalid credentials.'
            ]);
        }

        // 🚫 ACCOUNT IS INACTIVE
        if ($staff->status !== 'active') {
            return back()->with([
                'account_inactive' => true,
                'message' => 'Your account is inactive. Please contact the administrator.'
            ]);
        }

        // ✅ Authenticate
        Auth::guard('staff')->login($staff);

        // Record login time
        $staff->last_login = Carbon::now();
        $staff->save();

        // Log
        $this->writeStaffLog(
            "LOGIN: {$staff->name} ({$staff->role}) | Staff ID: {$staff->staff_id}"
        );

        return back()->with([
            'access_granted' => true,
            'role' => $staff->role,
            'message' => $staff->role === 'admin'
                ? 'Admin Access Granted'
                : 'Staff Access Granted'
        ]);
    }

    public function logout()
    {
        $staff = Auth::guard('staff')->user();

        if ($staff) {
            $staff->last_logout = Carbon::now();
            $staff->save();

            $this->writeStaffLog(
                "LOGOUT: {$staff->name} (Staff ID: {$staff->staff_id})"
            );
        }

        Auth::guard('staff')->logout();
        return redirect('login');
    }

    private function writeStaffLog($message)
    {
        $path = storage_path('logs/logs.txt');
        $timestamp = Carbon::now()->format('Y-m-d H:i:s');
        $entry = "[$timestamp] $message" . PHP_EOL;

        if (!File::exists(dirname($path))) {
            File::makeDirectory(dirname($path), 0755, true);
        }

        File::append($path, $entry);
    }
}
