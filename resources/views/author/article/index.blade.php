@extends('layouts.author-layout')

@section('title', 'My Articles')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="font-family:'Playfair Display',serif;font-weight:700;margin:0;">My Articles</h1>
    <a href="{{ route('author.articles.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#a855f7,#6366f1);">+ New Article</a>
</div>

@if(session('success'))
<div style="background:rgba(34,197,94,0.15);border:1px solid #22c55e;border-radius:12px;padding:14px;margin-bottom:20px;color:#22c55e;font-size:14px;">
  {{ session('success') }}
</div>
@endif

<div class="card-box">
    <table class="table mb-0">
        <thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Views</th><th>Date</th><th></th></tr></thead>
        <tbody>
        @forelse($articles as $article)
        <tr>
            <td>{{ Str::limit($article->title, 50) }}</td>
            <td>{{ $article->categoryRel?->name ?? '—' }}</td>
            <td><span class="badge bg-{{ $article->status === 'published' ? 'success' : 'warning' }}">{{ $article->status }}</span></td>
            <td>{{ $article->views }}</td>
            <td>{{ $article->created_at->format('M d, Y') }}</td>
            <td class="text-end">
                <a href="{{ route('author.articles.edit', $article->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('author.articles.publish', $article->id) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                    <button class="btn btn-sm btn-outline-success">{{ $article->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <form action="{{ route('author.articles.destroy', $article->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted py-4">No articles yet. <a href="{{ route('author.articles.create') }}">Write your first article</a></td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $articles->links() }}</div>
</div>
@endsection
