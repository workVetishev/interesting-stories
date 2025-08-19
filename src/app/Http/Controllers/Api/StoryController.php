<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class StoryController extends Controller
{
    public function showAll(Request $request)
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

    public function showElement(Request $request, int $id)
    {
        $showStory = Story::with('tags')->find($id);
        if (is_null($showStory))
        {
            return response()->json(['error' => 'Такого элемента нету.']);    
        }    

        dump($showStory->title);
        dump($showStory->content);
        dump($showStory->approved);


    }

    public function createFrom()
    {
        return view('story.create');
    }

    public function createElement(Request $request)
    {
        $validated = [];

        $rules = [
            'title'             => ['required', 'string', 'max:255'],
            'content'           => ['required', 'string'],
            'approved'          => ['boolean']
        ];

        $message = [
            'title.required'    => ':attribute обезательное для заполнения',
            'title.max'         => 'Максимальная длина :attribute 255 символов',
            'title.string'      => 'Поле :attribute должно быть строкой',

            'content'           => 'Поле :attrribute обезательное для заполнения',
            'content.string'    => 'Поле :attribute должно быть строкой',

            'approved.boolean'  => 'В неправильном формате',
        ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        
        if ($validator->fails())
        {
            return Redirect::route('stories.createForm')->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();


        dump($validated['title']);
        dump($validated['contents']);
        dump($validated['approved']);
        // Story::create([
        //     'title'             => $validated['title'],
        //     'content'           => $validated['content'],
        //     'approved'          => $validated['approved'] ?? false,
        // ]);

        return Redirect::route('stries.createForm')->with('success', 'История создана!');

    }
}
