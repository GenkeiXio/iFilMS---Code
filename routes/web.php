<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\StaffPasswordResetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TranscriptionController;
use App\Http\Controllers\MinutesController;
use App\Http\Controllers\ExcerptsController;
use App\Http\Controllers\SecretaryCertificationController;
use App\Http\Controllers\ReferendumController;
use App\Http\Controllers\BoardResolutionController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\CategoriesController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login']);
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('staff/forgot-password', [StaffPasswordResetController::class, 'showForgotPasswordForm'])->name('staff.password.request');
    Route::post('staff/forgot-password', [StaffPasswordResetController::class, 'sendResetLink'])->name('staff.password.email');
    Route::get('staff/reset-password/{token}', [StaffPasswordResetController::class, 'showResetPasswordForm'])->name('staff.password.reset');
    Route::post('staff/reset-password', [StaffPasswordResetController::class, 'resetPassword'])->name('staff.password.update');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/mainsidebar/documents', [DocumentsController::class, 'index'])
        ->name('mainsidebar.documents');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/mainsidebar/upload', function () {
        return view('MainSideBar.upload'); 
    })->name('mainsidebar.upload');

    Route::post('/upload', [UploadController::class, 'store'])->name('upload.store');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/mainsidebar/categories', [CategoriesController::class, 'index'])
        ->name('mainsidebar.categories');
});

Route::middleware('auth:staff')->group(function () {
    // Transcriptions landing page
    Route::get('/transcriptions', [App\Http\Controllers\TranscriptionController::class, 'index'])
        ->name('transcriptions.index');

    // Subcategories
    Route::get('/transcriptions/{category}', [App\Http\Controllers\TranscriptionController::class, 'list'])
        ->whereIn('category', ['academic-council', 'administrative-council', 'board-meetings'])
        ->name('transcriptions.list');
});


Route::middleware('auth:staff')->group(function () {
    // Minutes landing
    Route::get('/minutes', [App\Http\Controllers\MinutesController::class, 'index'])
        ->name('minutes.index');

    // Minutes subpages
    Route::get('/minutes/{category}', [App\Http\Controllers\MinutesController::class, 'list'])
        ->where('category', 'academic-council|administrative-council|board-meetings')
        ->name('minutes.list');
});

Route::middleware('auth:staff')->group(function () {
    // Excerpts landing
    Route::get('/excerpts', [App\Http\Controllers\ExcerptsController::class, 'index'])
        ->name('excerpts.index');

    // Board Meeting Excerpts
    Route::get('/excerpts/board', [App\Http\Controllers\ExcerptsController::class, 'list'])
        ->name('excerpts.list');
});


Route::middleware('auth:staff')->group(function () {
    Route::get('/secretary-certification', [App\Http\Controllers\SecretaryCertificationController::class, 'index'])
        ->name('secretary-certification.index');

    Route::post('/secretary-certification/upload', [App\Http\Controllers\SecretaryCertificationController::class, 'upload'])
        ->name('secretary-certification.upload');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/referendum', [App\Http\Controllers\ReferendumController::class, 'index'])
        ->name('referendum.index');

    Route::post('/referendum/upload', [App\Http\Controllers\ReferendumController::class, 'upload'])
        ->name('referendum.upload');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/board-resolution', [App\Http\Controllers\BoardResolutionController::class, 'index'])
        ->name('board-resolution.index');

    Route::post('/board-resolution/upload', [App\Http\Controllers\BoardResolutionController::class, 'upload'])
        ->name('board-resolution.upload');
});
