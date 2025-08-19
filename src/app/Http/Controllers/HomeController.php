<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Story;

class HomeController extends Controller
{
    public function index(): View
    {
        $stories = Story::where('status', 'approved')
            ->with('user') // только автор
            ->latest()
            ->limit(10)
            ->get();

        return view('home', compact('stories'));
    }
}