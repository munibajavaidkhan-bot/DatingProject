@extends('layouts.admin-layout')

@section('title', 'Forum Threads')
@section('page-title', 'Manage Forum')

@section('content')

@if(session('success'))
<div style="background:rgba(34,197,94,0.15);border:1px solid #22c55e;border-radius:12px;padding:14px;margin-bottom:20px;color:#22c55e;font-size:14px;">
  {{ session('success') }}
</div>
@endif

<div class="admin-card" style="padding:0;overflow:hidden;">
  <table style="width:100%;border-collapse:collapse;">
    <thead>
      <tr style="border-bottom:1px solid rgba(255,255,255,0.06);">
        @foreach(['Title','Author','Category','Replies','Views','Date','Actions'] as $h)
        <th style="padding:14px 20px;text-align:left;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;">{{ $h }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      @forelse($threads as $thread)
      <tr style="border-bottom:1px solid rgba(255,255,255,0.04);">
        <td style="padding:14px 20px;color:white;font-size:14px;font-weight:600;">{{ Str::limit($thread->title, 45) }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $thread->user?->name ?? '—' }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $thread->category?->name ?? '—' }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $thread->replies_count }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $thread->views }}</td>
        <td style="padding:14px 20px;color:#9ca3af;font-size:13px;">{{ $thread->created_at->format('M d') }}</td>
        <td style="padding:14px 20px;">
          <form action="{{ route('admin.forum.destroy', $thread->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this thread?')">
            @csrf @method('DELETE')
            <button type="submit" style="background:none;border:none;color:#ef4444;cursor:pointer;font-size:13px;"><i class="fas fa-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="7" style="padding:40px;text-align:center;color:#6b7280;">No forum threads yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $threads->links() }}</div>

@endsection
