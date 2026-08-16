<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Story::published()
            ->with('author')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('title', 'like', "%{$search}%")
                          ->orWhere('excerpt', 'like', "%{$search}%")
                          ->orWhere('category', 'like', "%{$search}%");
                });
            });

        $featured = Story::published()->where('is_featured', true)
            ->latest('published_at')->first();

        $stories = $query->latest('published_at')->paginate(12)->withQueryString();

        return view('user.stories', compact('stories', 'featured'));
    }

    public function show(string $slug)
    {
        $story = Story::published()->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $story->increment('views');

        $related = Story::published()
            ->where('id', '!=', $story->id)
            ->where(function ($q) use ($story) {
                $q->where('category', $story->category)
                  ->orWhere('is_featured', true);
            })
            ->latest('published_at')->take(4)->get();

        return view('user.story-show', compact('story', 'related'));
    }
}