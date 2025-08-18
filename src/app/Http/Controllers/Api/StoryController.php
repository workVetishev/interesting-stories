<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Story;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $arrStories = Story::where('approved', true)
            ->with('tags')
            ->latest()
            ->paginate(10);

        foreach ($arrStories as $storyData)
        {
            dump($storyData->title);
            dump($storyData->content);
            dump($storyData->approved);
        }
        
    }
}
