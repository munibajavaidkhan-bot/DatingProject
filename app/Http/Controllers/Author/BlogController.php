<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('author_id', auth()->id())->latest()->paginate(20);
        return view('author.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('author.blog.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('author.blog.index')->with('success', 'Blog post created successfully.');
    }

    public function edit($id)
    {
        $post = BlogPost::where('author_id', auth()->id())->findOrFail($id);
        return view('author.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('author.blog.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy($id)
    {
        BlogPost::where('author_id', auth()->id())->findOrFail($id)->delete();
        return redirect()->route('author.blog.index')->with('success', 'Blog post deleted successfully.');
    }

    public function publish(Request $request, $id)
    {
        $post = BlogPost::where('author_id', auth()->id())->findOrFail($id);
        $post->update(['is_published' => !$post->is_published]);
        return redirect()->route('author.blog.index')->with('success', 'Blog post status updated.');
    }
}