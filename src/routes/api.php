<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\TagController;

// API маршруты с автоматическим префиксом /api/
// Route::get('/stories', [StoryController::class, 'showAll'])->name('stories.showAll');
// Route::get('/stories/create', [StoryController::class, 'createElement'])->name('stories.createForm');
// Route::get('/stories/{id}', [StoryController::class, 'showElement'])->name('stories.showElement');
// Route::post('/stories', [StoryController::class, 'create'])->name('stories.create');
// Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
// Route::get('/tags/{id}/stories', [TagController::class, 'stories'])->name('tags.stories');