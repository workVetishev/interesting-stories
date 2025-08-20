<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoryRequest;
use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Tag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use mysql_xdevapi\Collection;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{

    /**
     * Показать историю
     * @param int $id
     * @return View
     */
    public function showElement(int $id): View
    {
        $showStory = Story::with('tags', 'user')->findOrFail($id);

        return view('show', ['story' => $showStory]);
    }

    /**
     * Показать форму создания истории
     * @return View
     */
    public function createForm(): View
    {
        return view('create');
    }


    public function createElement(CreateStoryRequest $request)
    {


        $story = Auth::user()->stories()->create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'pending',
        ]);

        if ($request->filled('tags'))
        {
            $tagNames = collect(explode(',',  $request->tags))
                ->map(fn ($tagName) => trim(strtolower(str_replace('#', '', $tagName))))
                ->filter()
                ->unique();
            $tags = $tagNames->map(fn ($tagName) => Tag::firstOrCreate(['name' => $tagName]));

            $story->tags()->attach($tags);

        }
        return redirect()->route('stories.createForm')->with('success', 'История отправлена на модерацию!');

    }
}
