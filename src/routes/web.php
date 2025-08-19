<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Авторизация
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group( function() {
    // Истории
    Route::get('/stories/{id}', [StoryController::class, 'showElement'])->name('stories.showElement');

    //Теги
    Route::get('/tags/{id}/stories', [TagController::class, 'stories'])->name('tag.show');
});





Route::middleware('auth')->prefix('api')->group( function() {
    Route::get('/stories', [StoryController::class, 'showAll'])->name('stories.showAll');
    Route::get('/stories/create', [StoryController::class, 'createForm'])->name('stories.createForm');

    Route::post('/stories', [StoryController::class, 'createElement'])->name('stories.createElement');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/{id}/stories', [TagController::class, 'stories'])->name('tags.stories');
});