<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Возвращает истории по имени тега
     * @param $name Имя тега
     * @return View
     */
    public function stories($name): View
    {

        $tag = Tag::where('name', $name)->firstOrFail();



        $stories = $tag->stories()
            ->where('status', Story::STATUS_PUBLISHED)
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('tag.stories', compact('tag', 'stories'));
    }
}
