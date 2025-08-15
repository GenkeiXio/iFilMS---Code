<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\StaffPasswordResetController;
use App\Http\Controllers\TranscriptionController;
use App\Http\Controllers\MinutesController;
use App\Http\Controllers\ExcerptsController;
use App\Http\Controllers\SecretaryCertificationController;
use App\Http\Controllers\ReferendumController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login']);
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

Route::middleware('auth:staff')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    });
});

Route::middleware('guest')->group(function () {
    Route::get('staff/forgot-password', [StaffPasswordResetController::class, 'showForgotPasswordForm'])->name('staff.password.request');
    Route::post('staff/forgot-password', [StaffPasswordResetController::class, 'sendResetLink'])->name('staff.password.email');
    Route::get('staff/reset-password/{token}', [StaffPasswordResetController::class, 'showResetPasswordForm'])->name('staff.password.reset');
    Route::post('staff/reset-password', [StaffPasswordResetController::class, 'resetPassword'])->name('staff.password.update');
});

Route::middleware('auth:staff')->group(function () {
    // Top-level Transcriptions landing
    Route::get('/transcriptions', [TranscriptionController::class, 'index'])
        ->name('transcriptions.index');

    // Subpages: academic-council, administrative-council, board-meetings
    Route::get('/transcriptions/{category}', [TranscriptionController::class, 'list'])
        ->whereIn('category', ['academic-council','administrative-council','board-meetings'])
        ->name('transcriptions.list');

    // Upload POST endpoint (can be implemented later)
    Route::post('/transcriptions/{category}/upload', [TranscriptionController::class, 'upload'])
        ->whereIn('category', ['academic-council','administrative-council','board-meetings'])
        ->name('transcriptions.upload');
});

Route::middleware('auth:staff')->group(function () {
    // Minutes landing
    Route::get('/minutes', [MinutesController::class, 'index'])
        ->name('minutes.index');

    // Minutes subpages
    Route::get('/minutes/{category}', [MinutesController::class, 'list'])
        ->whereIn('category', ['academic-council','administrative-council','board-meetings'])
        ->name('minutes.list');

    // Upload POST
    Route::post('/minutes/{category}/upload', [MinutesController::class, 'upload'])
        ->whereIn('category', ['academic-council','administrative-council','board-meetings'])
        ->name('minutes.upload');
});

Route::middleware('auth:staff')->group(function () {
    // Excerpts landing page
    Route::get('/excerpts', [ExcerptsController::class, 'index'])
        ->name('excerpts.index');

    // Single subpage: Board Meetings
    Route::get('/excerpts/board-meetings', [ExcerptsController::class, 'list'])
        ->name('excerpts.board');

    // Upload POST
    Route::post('/excerpts/board-meetings/upload', [ExcerptsController::class, 'upload'])
        ->name('excerpts.upload');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/secretary-certification', [SecretaryCertificationController::class, 'index'])
        ->name('secretary-certification.index');

    Route::post('/secretary-certification/upload', [SecretaryCertificationController::class, 'upload'])
        ->name('secretary-certification.upload');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/referendum', [ReferendumController::class, 'index'])
        ->name('referendum.index');

    Route::post('/referendum/upload', [ReferendumController::class, 'upload'])
        ->name('referendum.upload');
});