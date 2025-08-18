<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\Admin\StoryController as AdminStoryController;


// Route::get('/stories', [StoryController::class, 'index'])->name('showStories');

    // Подключаем все API маршруты из папки api/
    require base_path('routes/api/stories.php');
    require base_path('routes/api/tags.php');
