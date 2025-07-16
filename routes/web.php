<?php

use App\Http\Controllers\StaffAuthController;

// Public login routes (no auth needed)
Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login']);
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

// Protected routes (requires staff to be logged in)
Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
});
