<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::published()
            ->with('author')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('title', 'like', "%{$search}%")
                          ->orWhere('excerpt', 'like', "%{$search}%")
                          ->orWhere('category', 'like', "%{$search}%");
                });
            });

        $featured = Article::published()->where('is_featured', true)
            ->latest('published_at')->first();

        $articles = $query->latest('published_at')->paginate(12)->withQueryString();

        return view('user.articles', compact('articles', 'featured'));
    }

    public function show(string $slug)
    {
        $article = Article::published()->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $article->increment('views');

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where(function ($q) use ($article) {
                $q->where('category', $article->category)
                  ->orWhere('is_featured', true);
            })
            ->latest('published_at')->take(4)->get();

        return view('user.article-show', compact('article', 'related'));
    }
}