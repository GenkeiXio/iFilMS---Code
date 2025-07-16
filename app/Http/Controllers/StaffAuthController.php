<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;

class StaffAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $staff = Staff::where('username', $request->username)->first();

        if ($staff && Hash::check($request->password, $staff->password)) {
            Auth::guard('staff')->login($staff);
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['error' => 'Invalid credentials.']);
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect('/login');
    }
}
