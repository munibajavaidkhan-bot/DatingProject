<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with(['author', 'category'])->latest()->paginate(20);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();
        $authors    = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();

        return view('admin.blog.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePost($request);

        BlogPost::create([
            'user_id'      => $data['user_id'],
            'category_id'  => $data['category_id'],
            'title'        => $data['title'],
            'slug'         => $this->uniqueSlug($data['title']),
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
    }

    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();
        $authors    = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();

        return view('admin.blog.edit', compact('post', 'categories', 'authors'));
    }

    public function update(Request $request, int $id)
    {
        $post = BlogPost::findOrFail($id);
        $data = $this->validatePost($request);

        $post->update([
            'user_id'      => $data['user_id'],
            'category_id'  => $data['category_id'],
            'title'        => $data['title'],
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'published_at' => $data['status'] === 'published' ? ($post->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated.');
    }

    public function destroy(int $id)
    {
        BlogPost::findOrFail($id)->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'min:10', 'max:200'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string', 'min:50'],
            'category_id' => ['required', 'exists:blog_categories,id'],
            'user_id'     => ['required', 'exists:users,id'],
            'status'      => ['required', 'in:draft,published,archived'],
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i    = 1;

        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
