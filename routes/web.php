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
use App\Http\Controllers\RecycleBinController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [StaffAuthController::class, 'login']);
Route::post('/logout', [StaffAuthController::class, 'logout'])->name('logout');

Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/admin/admindashboard', [DashboardController::class, 'index'])
        ->middleware('admin')
        ->name('admin.admindashboard');
});


Route::middleware('guest')->group(function () {
    Route::get('staff/forgot-password', [StaffPasswordResetController::class, 'showForgotPasswordForm'])->name('staff.password.request');
    Route::post('staff/forgot-password', [StaffPasswordResetController::class, 'sendResetLink'])->name('staff.password.email');
    Route::get('staff/reset-password/{token}', [StaffPasswordResetController::class, 'showResetPasswordForm'])->name('staff.password.reset');
    Route::post('staff/reset-password', [StaffPasswordResetController::class, 'resetPassword'])->name('staff.password.update');
});

Route::middleware('auth:staff')->group(function () {

    // Existing route for active documents
    Route::get('/mainsidebar/documents', [DocumentsController::class, 'index'])
        ->name('mainsidebar.documents');

    Route::delete('/documents/{id}/soft-delete', [DocumentsController::class, 'softDelete'])
        ->name('documents.softDelete');

    // 🗑 Recycle Bin Routes
    Route::get('/mainsidebar/recycle-bin', [RecycleBinController::class, 'index'])
        ->name('mainsidebar.recyclebin');

    Route::post('/recycle-bin/{id}/restore', [RecycleBinController::class, 'restore'])
        ->name('recyclebin.restore');

    Route::delete('/recycle-bin/{id}/destroy', [RecycleBinController::class, 'destroy'])
        ->name('recyclebin.destroy');
});


Route::middleware('auth:staff')->group(function () {

    // Upload page (permission-checked)
    Route::get('/mainsidebar/upload', [UploadController::class, 'create'])
        ->name('mainsidebar.upload');

    // Upload submit (hard-blocked in controller)
    Route::post('/upload', [UploadController::class, 'store'])
        ->name('upload.store');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/mainsidebar/categories', [CategoriesController::class, 'index'])
        ->name('mainsidebar.categories');
});

Route::middleware('auth:staff')->group(function () {
    //Documents Page
    Route::get('/mainsidebar/documents', [DocumentsController::class, 'index'])
        ->name('mainsidebar.documents');

    //Recycle Bin Page
    Route::get('/mainsidebar/recycle-bin', [RecycleBinController::class, 'index'])
        ->name('mainsidebar.recycle-bin');

    // Custom download route
    Route::get('/documents/download/{id}', [DocumentsController::class, 'download'])
        ->name('documents.download');

    Route::get('/documents/view/{id}', [DocumentsController::class, 'view'])
    ->name('documents.view');

});

Route::middleware(['auth:staff', 'admin'])->group(function () {

    Route::get('/admin/users', [UsersController::class, 'index'])
        ->name('admin.users');

    Route::post('/admin/users', [UsersController::class, 'store'])
        ->name('admin.users.store');

    Route::get('/admin/users/{id}/edit', [UsersController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/admin/users/{id}', [UsersController::class, 'update'])
        ->name('admin.users.update');

    Route::patch('/admin/users/{id}/toggle', [UsersController::class, 'toggleStatus'])
        ->name('admin.users.toggle');

    Route::post('/admin/users/{id}/reset-password', [UsersController::class, 'resetPassword'])
        ->name('admin.users.reset');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/dashboard/analytics-data', [DashboardController::class, 'analyticsData'])
        ->name('dashboard.analyticsData');
});

Route::middleware('auth:staff')->group(function () {
    // Transcriptions landing page
    Route::get('/transcriptions', [App\Http\Controllers\TranscriptionController::class, 'index'])
        ->name('transcriptions.index');

    // Subcategories
    Route::get('/transcriptions/{category}', [App\Http\Controllers\TranscriptionController::class, 'list'])
        ->whereIn('category', ['academic-council', 'administrative-council', 'board-meetings'])
        ->name('transcriptions.list');

    Route::delete('/transcriptions/{id}/delete', [TranscriptionController::class, 'softDelete'])
        ->name('transcriptions.softDelete');

    // Custom download route
    Route::get('/transcriptions/download/{id}', [TranscriptionController::class, 'download'])
        ->name('transcriptions.download');

    Route::get('/transcriptions/view/{id}', [TranscriptionController::class, 'view'])
        ->name('transcriptions.view');
});


Route::middleware('auth:staff')->group(function () {
    // Minutes landing
    Route::get('/minutes', [App\Http\Controllers\MinutesController::class, 'index'])
        ->name('minutes.index');

    // Minutes subpages
    Route::get('/minutes/{category}', [App\Http\Controllers\MinutesController::class, 'list'])
        ->where('category', 'academic-council|administrative-council|board-meetings')
        ->name('minutes.list');

    Route::delete('/minutes/{id}/delete', [MinutesController::class, 'softDelete'])
        ->name('minutes.softDelete');

    // Custom download route
    Route::get('/minutes/download/{id}', [MinutesController::class, 'download'])
        ->name('minutes.download');

    Route::get('/minutes/view/{id}', [MinutesController::class, 'view'])
        ->name('minutes.view');
});

Route::middleware('auth:staff')->group(function () {
    // Excerpts landing
    Route::get('/excerpts', [App\Http\Controllers\ExcerptsController::class, 'index'])
        ->name('excerpts.index');

    // Board Meeting Excerpts
    Route::get('/excerpts/board', [App\Http\Controllers\ExcerptsController::class, 'list'])
        ->name('excerpts.list');
    
    Route::delete('/excerpts/{id}/delete', [ExcerptsController::class, 'softDelete'])
        ->name('excerpts.softDelete');   
    
    // Custom download route
    Route::get('/excerpts/download/{id}', [ExcerptsController::class, 'download'])
        ->name('excerpts.download');

    Route::get('/excerpts/view/{id}', [ExcerptsController::class, 'view'])
        ->name('excerpts.view');
});


Route::middleware('auth:staff')->group(function () {
    Route::get('/secretary-certification', [App\Http\Controllers\SecretaryCertificationController::class, 'index'])
        ->name('secretary-certification.index');

    Route::post('/secretary-certification/upload', [App\Http\Controllers\SecretaryCertificationController::class, 'upload'])
        ->name('secretary-certification.upload');

    Route::delete('/secretary-certification/{id}/delete', [SecretaryCertificationController::class, 'softDelete'])
        ->name('secretary-certification.softDelete');

    // Custom download route
    Route::get('/secretary-certification/download/{id}', [SecretaryCertificationController::class, 'download'])
        ->name('secretary-certification.download');

    Route::get('/secretary-certification/view/{id}', [SecretaryCertificationController::class, 'view'])
        ->name('secretary-certification.view');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/referendum', [App\Http\Controllers\ReferendumController::class, 'index'])
        ->name('referendum.index');

    Route::post('/referendum/upload', [App\Http\Controllers\ReferendumController::class, 'upload'])
        ->name('referendum.upload');

    Route::delete('/referendum/{id}/delete', [ReferendumController::class, 'softDelete'])
        ->name('referendum.softDelete');
    
    // Custom download route
    Route::get('/referendum/download/{id}', [ReferendumController::class, 'download'])
        ->name('referendum.download');

    Route::get('/referendum/view/{id}', [ReferendumController::class, 'view'])
        ->name('referendum.view');
});

Route::middleware('auth:staff')->group(function () {
    Route::get('/board-resolution', [App\Http\Controllers\BoardResolutionController::class, 'index'])
        ->name('board-resolution.index');

    Route::post('/board-resolution/upload', [App\Http\Controllers\BoardResolutionController::class, 'upload'])
        ->name('board-resolution.upload');

    Route::delete('/board-resolution/{id}/delete', [BoardResolutionController::class, 'softDelete'])
        ->name('board-resolution.softDelete');

    // Custom download route
    Route::get('/board-resolution/download/{id}', [BoardResolutionController::class, 'download'])
        ->name('board-resolution.download');

    Route::get('/board-resolution/view/{id}', [BoardResolutionController::class, 'view'])
        ->name('board-resolution.view');
});
