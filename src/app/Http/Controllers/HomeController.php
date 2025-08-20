<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Story;

class HomeController extends Controller
{
    public function index(): View
    {
        $stories = Story::query()
            ->where('status', Story::STATUS_PUBLISHED)
            ->with('user') // только автор
            ->latest()
            ->paginate(10);

        return view('home', compact('stories'));
    }
}
