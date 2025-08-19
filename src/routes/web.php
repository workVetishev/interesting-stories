<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\TagController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('api')->group( function() {
    Route::get('/stories', [StoryController::class, 'showAll'])->name('stories.showAll');
    Route::get('/stories/create', [StoryController::class, 'createForm'])->name('stories.createForm');
    Route::get('/stories/{id}', [StoryController::class, 'showElement'])->name('stories.showElement');
    Route::post('/stories', [StoryController::class, 'createElement'])->name('stories.createElement');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/{id}/stories', [TagController::class, 'stories'])->name('tags.stories');
});