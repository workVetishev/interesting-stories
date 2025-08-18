<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\TagController;

// API маршруты с автоматическим префиксом /api/
Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
Route::get('/stories/{id}', [StoryController::class, 'show'])->name('stories.show');
Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{id}/stories', [TagController::class, 'stories'])->name('tags.stories');