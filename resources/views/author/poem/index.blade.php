@extends('layouts.author-layout')

@section('title', 'My Poems')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="font-family:'Playfair Display',serif;font-weight:700;margin:0;">My Poems</h1>
    <a href="{{ route('author.poems.create') }}" class="btn text-white" style="background:linear-gradient(135deg,#a855f7,#ec4899);">+ New Poem</a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card-box">
    <table class="table mb-0">
        <thead><tr><th>Title</th><th>Status</th><th>Views</th><th>Date</th><th></th></tr></thead>
        <tbody>
        @forelse($poems as $poem)
        <tr>
            <td>{{ Str::limit($poem->title, 50) }}
                @if($poem->is_featured)<span class="badge bg-danger ms-2">Featured</span>@endif
            </td>
            <td><span class="badge bg-{{ $poem->status === 'published' ? 'success' : 'warning' }}">{{ $poem->status }}</span></td>
            <td>{{ $poem->views }}</td>
            <td>{{ $poem->created_at->format('M d, Y') }}</td>
            <td class="text-end">
                <a href="{{ route('author.poems.edit', $poem->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('author.poems.publish', $poem->id) }}" method="POST" class="d-inline">@csrf @method('PATCH')
                    <button class="btn btn-sm btn-outline-success">{{ $poem->status === 'published' ? 'Unpublish' : 'Publish' }}</button>
                </form>
                <form action="{{ route('author.poems.destroy', $poem->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" class="text-center text-muted py-4">No poems yet. <a href="{{ route('author.poems.create') }}">Write your first poem</a></td></tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3">{{ $poems->links() }}</div>
</div>
@endsection