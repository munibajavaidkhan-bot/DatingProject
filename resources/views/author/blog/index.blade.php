@extends('layouts.author-layout')

@section('title', 'My Articles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="font-family:'Playfair Display',serif;font-weight:700;margin:0;">My Articles</h1>
    <a href="{{ route('author.blog.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#a855f7,#6366f1);">+ New Article</a>
</div>

<div class="card-box">
    <table class="table mb-0">
        <thead><tr><th>Title</th><th>Status</th><th>Views</th><th>Date</th><th></th></tr></thead>
        <tbody>
        @forelse($posts as $post)
        <tr>
            <td>{{ Str::limit($post->title, 50) }}</td>
            <td><span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">{{ $post->status }}</span></td>
            <td>{{ $post->views }}</td>
            <td>{{ $post->created_at->format('M d, Y') }}</td>
            <td class="text-end">
                <a href="{{ route('author.blog.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('author.blog.publish', $post->id) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                    <button class="btn btn-sm btn-outline-success">{{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <form action="{{ route('author.blog.destroy', $post->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-4">No articles yet. <a href="{{ route('author.blog.create') }}">Write your first post</a></td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $posts->links() }}</div>
</div>
@endsection
