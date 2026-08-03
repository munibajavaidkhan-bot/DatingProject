<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('user_id', auth()->id())
            ->with('category')
            ->latest()
            ->paginate(15);

        return view('author.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();

        return view('author.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePost($request);

        $slug = $this->uniqueSlug($data['title']);
        $status = $request->boolean('publish') ? 'published' : 'draft';

        BlogPost::create([
            'user_id'      => auth()->id(),
            'category_id'  => $data['category_id'],
            'title'        => $data['title'],
            'slug'         => $slug,
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'status'       => $status,
            'is_featured'  => false,
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'published_at' => $status === 'published' ? now() : null,
        ]);

        return redirect()->route('author.blog.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(int $id)
    {
        $post = BlogPost::where('user_id', auth()->id())->findOrFail($id);
        $categories = BlogCategory::where('is_active', true)->orderBy('name')->get();

        return view('author.blog.edit', compact('post', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $post = BlogPost::where('user_id', auth()->id())->findOrFail($id);
        $data = $this->validatePost($request);

        $status = $request->boolean('publish') ? 'published' : ($request->input('status', $post->status));

        $post->update([
            'category_id'  => $data['category_id'],
            'title'        => $data['title'],
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'status'       => $status,
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'published_at' => $status === 'published' ? ($post->published_at ?? now()) : null,
        ]);

        return redirect()->route('author.blog.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(int $id)
    {
        BlogPost::where('user_id', auth()->id())->findOrFail($id)->delete();

        return redirect()->route('author.blog.index')
            ->with('success', 'Blog post deleted.');
    }

    public function publish(int $id)
    {
        $post = BlogPost::where('user_id', auth()->id())->findOrFail($id);

        $newStatus = $post->status === 'published' ? 'draft' : 'published';
        $post->update([
            'status'       => $newStatus,
            'published_at' => $newStatus === 'published' ? ($post->published_at ?? now()) : null,
        ]);

        return back()->with('success', 'Post ' . ($newStatus === 'published' ? 'published' : 'unpublished') . '.');
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'min:10', 'max:200'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string', 'min:50'],
            'category_id' => ['required', 'exists:blog_categories,id'],
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
