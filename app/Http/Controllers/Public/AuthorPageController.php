<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\Story;
use App\Models\Poem;

class AuthorPageController extends Controller
{
    public function show(string $slug)
    {
        $name = str_replace('-', ' ', $slug);

        $author = User::where('role', 'author')
            ->whereRaw("LOWER(name) LIKE ?", ['%' . strtolower($name) . '%'])
            ->firstOrFail();

        $articles = Article::published()
            ->where('user_id', $author->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $stories = Story::published()
            ->where('user_id', $author->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $poems = Poem::where('user_id', $author->id)
            ->latest()
            ->take(3)
            ->get();

        $articleCount = Article::published()->where('user_id', $author->id)->count();
        $storyCount   = Story::published()->where('user_id', $author->id)->count();
        $poemCount    = Poem::where('user_id', $author->id)->count();

        return view('user.author-page', compact(
            'author', 'articles', 'stories', 'poems',
            'articleCount', 'storyCount', 'poemCount'
        ));
    }
}
