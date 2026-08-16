@extends('layouts.admin-layout')

@section('title', 'Stories')
@section('page-title', 'Manage Stories')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
  <p style="color:#9ca3af;font-size:14px;margin:0;">{{ $stories->total() }} stories total</p>
  <a href="{{ route('admin.stories.create') }}" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:600;">
    <i class="fas fa-plus me-2"></i>New Story
  </a>
</div>

@if(session('success'))
<div style="background:rgba(34,197,94,0.15);border:1px solid #22c55e;border-radius:12px;padding:14px;margin-bottom:20px;color:#22c55e;font-size:14px;">
  {{ session('success') }}
</div>
@endif

<div class="admin-card" style="padding:0;overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        @foreach(['Title','Author','Category','Status','Views','Date','Actions'] as $h)
        <th style="padding:14px 20px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;">{{ $h }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @forelse($stories as $story)
      <tr style="border-bottom:1px solid rgba(255,255,255,0.04);">
        <td style="padding:14px 20px;color:white;font-size:14px;font-weight:600;">{{ Str::limit($story->title, 50) }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $story->author?->name ?? '—' }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $story->categoryRel?->name ?? '—' }}</td>
        <td style="padding:14px 20px;">
          <span style="background:{{ $story->status === 'published' ? 'rgba(34,197,94,0.15)' : 'rgba(245,158,11,0.15)' }};color:{{ $story->status === 'published' ? '#22c55e' : '#f59e0b' }};font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:capitalize;">
            {{ $story->status }}
          </span>
        </td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $story->views }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $story->created_at->format('M d, Y') }}</td>
        <td style="padding:14px 20px;">
          <a href="{{ route('admin.stories.edit', $story->id) }}" style="color:#a855f7;font-size:13px;text-decoration:none;margin-right:12px;"><i class="fas fa-edit"></i></a>
          <form action="{{ route('admin.stories.destroy', $story->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this story?')">
            @csrf @method('DELETE')
            <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:13px;"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="padding:40px;text-align:center;color:#6b7280;">No stories yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $stories->links() }}</div>

@endsection
