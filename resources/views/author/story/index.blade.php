@extends('layouts.author-layout')

@section('title', 'My Stories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="font-family:'Playfair Display',serif;font-weight:700;margin:0;">My Stories</h1>
    <a href="{{ route('author.stories.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#a855f7,#6366f1);">+ New Story</a>
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
        @forelse($stories as $story)
        <tr>
            <td>{{ Str::limit($story->title, 50) }}</td>
            <td>{{ $story->categoryRel?->name ?? '—' }}</td>
            <td><span class="badge bg-{{ $story->status === 'published' ? 'success' : 'warning' }}">{{ $story->status }}</span></td>
            <td>{{ $story->views }}</td>
            <td>{{ $story->created_at->format('M d, Y') }}</td>
            <td class="text-end">
                <a href="{{ route('author.stories.edit', $story->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('author.stories.publish', $story->id) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                    <button class="btn btn-sm btn-outline-success">{{ $story->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <form action="{{ route('author.stories.destroy', $story->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="text-center text-muted py-4">No stories yet. <a href="{{ route('author.stories.create') }}">Write your first story</a></td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $stories->links() }}</div>
</div>
@endsection
