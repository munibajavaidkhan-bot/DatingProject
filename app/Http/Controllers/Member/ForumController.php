<?php

namespace App\Http\Controllers\Member;

// app/Http/Controllers/Member/ForumController.php

use App\Http\Controllers\Controller;
use App\Models\ForumCategory;
use App\Models\ForumThread;
use App\Models\ForumPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $categories = ForumCategory::where('is_active', true)
            ->withCount('threads')
            ->orderBy('sort_order')
            ->get();

        $query = ForumThread::where('is_published', true)
            ->with(['user.profile', 'category'])
            ->withCount('posts');

        // Filter by category
        if ($request->category) {
            $cat = ForumCategory::where('slug', $request->category)->first();
            if ($cat) $query->where('category_id', $cat->id);
        }

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('body', 'like', "%{$request->search}%");
            });
        }

        // Sort
        $sort = $request->sort ?? 'latest';
        match ($sort) {
            'popular' => $query->orderByDesc('likes_count'),
            'replies' => $query->orderByDesc('replies_count'),
            'views'   => $query->orderByDesc('views'),
            default   => $query->orderByDesc('is_pinned')->orderByDesc('created_at'),
        };

        $threads = $query->paginate(15);

        $totalThreads = ForumThread::where('is_published', true)->count();
        $totalPosts   = ForumPost::where('is_published', true)->count();

        return view('user.forum', compact(
            'user', 'categories', 'threads', 'totalThreads', 'totalPosts'
        ));
    }

    public function create()
    {
        $categories = ForumCategory::where('is_active', true)
            ->orderBy('sort_order')->get();
        return view('user.forum-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => ['required', 'string', 'max:200', 'min:10'],
            'body'        => ['required', 'string', 'min:20'],
            'category_id' => ['required', 'exists:forum_categories,id'],
            'tags'        => ['nullable', 'array', 'max:5'],
        ]);

        $slug = Str::slug($request->title);
        $base = $slug;
        $i    = 1;
        while (ForumThread::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        $thread = ForumThread::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'slug'        => $slug,
            'body'        => $request->body,
            'tags'        => $request->tags,
            'is_published'=> true,
        ]);

        // Update thread count on category
        $thread->category->increment('threads_count');

        return redirect()->route('member.forum.show', $thread->slug)
            ->with('success', 'Thread created successfully!');
    }

    public function show(string $slug)
    {
        $user   = Auth::user();
        $thread = ForumThread::where('slug', $slug)
            ->where('is_published', true)
            ->with(['user.profile', 'category'])
            ->firstOrFail();

        // Increment views
        $thread->increment('views');

        // Load posts with nested replies
        $posts = ForumPost::where('thread_id', $thread->id)
            ->whereNull('parent_id')
            ->where('is_published', true)
            ->with(['user.profile', 'replies.user.profile'])
            ->orderBy('created_at')
            ->paginate(20);

        // Related threads
        $related = ForumThread::where('category_id', $thread->category_id)
            ->where('id', '!=', $thread->id)
            ->where('is_published', true)
            ->orderByDesc('created_at')
            ->take(4)
            ->get();

        return view('user.forum-show', compact('user', 'thread', 'posts', 'related'));
    }

    public function reply(Request $request, int $id)
    {
        $request->validate([
            'body'      => ['required', 'string', 'min:5', 'max:2000'],
            'parent_id' => ['nullable', 'exists:forum_posts,id'],
        ]);

        $thread = ForumThread::findOrFail($id);

        if ($thread->is_locked) {
            return back()->with('error', 'This thread is locked.');
        }

        $post = ForumPost::create([
            'thread_id'  => $thread->id,
            'user_id'    => Auth::id(),
            'parent_id'  => $request->parent_id,
            'body'       => $request->body,
            'is_published' => true,
        ]);

        // Update thread stats
        $thread->increment('replies_count');
        $thread->update(['last_reply_at' => now()]);

        // Notify thread author
        if ($thread->user_id !== Auth::id()) {
            \App\Models\Notification::create([
                'user_id'      => $thread->user_id,
                'from_user_id' => Auth::id(),
                'type'         => 'forum_reply',
                'title'        => 'New Reply on Your Thread',
                'message'      => Auth::user()->name . ' replied to "' . Str::limit($thread->title, 40) . '"',
                'icon'         => 'fa-comments',
                'color'        => '#a855f7',
                'action_url'   => route('member.forum.show', $thread->slug),
            ]);
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'post_id' => $post->id]);
        }

        return redirect()->route('member.forum.show', $thread->slug)
            ->with('success', 'Reply posted!');
    }

    public function like(int $id)
    {
        $thread = ForumThread::findOrFail($id);
        $user   = Auth::user();

        $like = \App\Models\ForumLike::where('user_id', $user->id)
            ->where('likeable_id', $thread->id)
            ->where('likeable_type', ForumThread::class)
            ->first();

        if ($like) {
            $like->delete();
            $thread->decrement('likes_count');
            $liked = false;
        } else {
            \App\Models\ForumLike::create([
                'user_id'       => $user->id,
                'likeable_id'   => $thread->id,
                'likeable_type' => ForumThread::class,
            ]);
            $thread->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'success' => true,
            'liked'   => $liked,
            'count'   => $thread->fresh()->likes_count,
        ]);
    }
}