<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileEditController;
use App\Http\Controllers\MyPostsController;
use App\Http\Controllers\ReportModerationController;
/*
|--------------------------------------------------------------------------
| Public Routes (No Login Required)
|--------------------------------------------------------------------------
*/

// MAIN PAGE
Route::get('/', function () {
    return view('mainpage'); // resources/views/mainpage.blade.php
})->name('mainpage');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/admin/reports', [ReportModerationController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/resolve/{id}', [ReportModerationController::class, 'resolve'])->name('admin.resolve');
Route::delete('/admin/reports/delete/{id}', [ReportModerationController::class, 'deletePost'])->name('admin.deletePost');

/*
|--------------------------------------------------------------------------
| Protected Routes (Login Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/feed', [FeedController::class, 'index'])->name('feed');
    Route::get('/myposts', [PostController::class, 'myPosts'])->name('myposts');

    // PROFILE PAGES

    // Show profile page
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Show edit profile page
    Route::get('/profile/edit', [ProfileEditController::class, 'edit'])->name('profile.edit');

    // Update profile
    Route::put('/profile', [ProfileEditController::class, 'update'])->name('profile.update');

    // Delete profile
    Route::delete('/profile', [ProfileEditController::class, 'destroy'])->name('profile.destroy');

    Route::post('/profile/notification', [ProfileController::class, 'updateNotification'])
         ->name('profile.notification');

    Route::get('/myposts', [MyPostsController::class, 'index'])->name('myposts');

    // URL: /admin/reports/{id}/status
    Route::post('/admin/reports/{id}/status', [ReportModerationController::class, 'updateStatus']);

    
});


