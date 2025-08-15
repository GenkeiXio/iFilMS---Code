<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class StaffPasswordResetController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('Authentication.staff-forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['username' => 'required|email']);

        $staff = Staff::where('username', $request->username)->first();

        if (!$staff) {
            return back()->withErrors(['username' => 'No account found with that email.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['username' => $staff->username],
            [
                'token' => $token, // Save raw token (no hashing)
                'created_at' => Carbon::now()
            ]
        );

        Mail::send('Authentication.staff-reset-email', ['token' => $token], function ($message) use ($staff) {
            $message->to($staff->username);
            $message->subject('iFiLMS Password Reset');
        });

        return back()->with('status', 'Reset link has been sent to your email.');
    }

    public function showResetPasswordForm($token)
    {
        return view('Authentication.staff-reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')
            ->where('username', $request->username)
            ->first();

        if (!$reset || $reset->token !== $request->token) {
            return back()->withErrors(['username' => 'Invalid or expired reset token.']);
        }

        $staff = Staff::where('username', $request->username)->first();

        if (!$staff) {
            return back()->withErrors(['username' => 'No account found.']);
        }

        $staff->password = Hash::make($request->password);
        $staff->save();

        DB::table('password_resets')->where('username', $request->username)->delete();

        return redirect('/login')->with('status', 'Your password has been reset!');
    }
}
