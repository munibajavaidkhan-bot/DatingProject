<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Poem;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function index(Request $request)
    {
        $query = Poem::published()
            ->with('author')
            ->when($request->search, function ($q, $search) {
                $q->where(function ($inner) use ($search) {
                    $inner->where('title', 'like', "%{$search}%")
                          ->orWhere('excerpt', 'like', "%{$search}%");
                });
            });

        $featured = Poem::published()->where('is_featured', true)
            ->latest('published_at')->first();

        $poems = $query->latest('published_at')->paginate(12)->withQueryString();

        return view('user.poems', compact('poems', 'featured'));
    }

    public function show(string $slug)
    {
        $poem = Poem::published()->with('author')
            ->where('slug', $slug)
            ->firstOrFail();

        $poem->increment('views');

        return view('user.poem-show', compact('poem'));
    }
}