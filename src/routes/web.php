<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Авторизация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





Route::middleware('auth')->group( function() {
    // Истории
    Route::get('/stories/create', [StoryController::class, 'createForm'])->name('stories.createForm');
    Route::post('/stories', [StoryController::class, 'createElement'])->name('stories.createElement');
});

Route::get('/stories/{id}', [StoryController::class, 'showElement'])->name('stories.showElement');
Route::get('/tags/{name}/stories', [TagController::class, 'stories'])->name('tags.show');


Route::middleware(['auth', 'moderator'])->prefix('admin')->name('admin.')->group( function() {
    Route::get('/stories', [AdminController::class, 'index'])->name('stories.index');
    Route::post('/stories/{id}/approve', [AdminController::class, 'approve'])->name('stories.approve');
    Route::post('/stories/{id}/reject', [AdminController::class, 'reject'])->name('stories.reject');
});
