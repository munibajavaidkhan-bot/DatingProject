<?php

namespace App\Http\Controllers\Member;

// app/Http/Controllers/Member/BlogController.php

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::where('is_active', true)->get();

        $query = BlogPost::where('status', 'published')
            ->with(['author.profile', 'category'])
            ->withCount('comments');

        if ($request->category) {
            $cat = BlogCategory::where('slug', $request->category)->first();
            if ($cat) $query->where('category_id', $cat->id);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('excerpt', 'like', "%{$request->search}%");
            });
        }

        $featured = BlogPost::where('status', 'published')
            ->where('is_featured', true)
            ->with(['author.profile', 'category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $posts = $query->latest('published_at')->paginate(9);

        return view('user.blog', compact('posts', 'categories', 'featured'));
    }

    public function show(string $slug)
    {
        $user = Auth::user();
        $post = BlogPost::where('slug', $slug)
            ->where('status', 'published')
            ->with(['author.profile', 'category',
                'comments' => fn($q) => $q->where('is_approved', true)
                    ->with('user.profile')->orderBy('created_at')
            ])
            ->firstOrFail();

        $post->increment('views');

        $related = BlogPost::where('status', 'published')
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->take(3)->get();

        return view('user.blog-show', compact('user', 'post', 'related'));
    }

    public function comment(Request $request, int $id)
    {
        $request->validate(['body' => ['required', 'string', 'min:5', 'max:1000']]);

        $post = BlogPost::findOrFail($id);

        BlogComment::create([
            'post_id'     => $post->id,
            'user_id'     => Auth::id(),
            'body'        => $request->body,
            'is_approved' => true, // auto approve for now
        ]);

        return back()->with('success', 'Comment posted!');
    }
}