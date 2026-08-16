@extends('layouts.admin-layout')

@section('title', 'Chat Management')
@section('page-title', 'Chat Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p style="color:#9ca3af;font-size:14px;margin:0;">Monitor and manage all chat conversations between matched users.</p>
    <form method="GET" class="d-flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
            style="background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:8px 14px;color:#e5e7eb;font-size:13px;width:250px;">
        <button type="submit" class="admin-btn"><i class="fas fa-search me-1"></i> Search</button>
    </form>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User 1</th>
                    <th>User 2</th>
                    <th>Messages</th>
                    <th>Last Message</th>
                    <th>Matched</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matches as $match)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <img src="{{ $match->userOne->getAvatarUrl() }}" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                            <div>
                                <div style="color:#e5e7eb;font-weight:600;font-size:13px;">{{ $match->userOne->name }}</div>
                                <div style="color:#6b7280;font-size:11px;">ID: {{ $match->user_one_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <img src="{{ $match->userTwo->getAvatarUrl() }}" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                            <div>
                                <div style="color:#e5e7eb;font-weight:600;font-size:13px;">{{ $match->userTwo->name }}</div>
                                <div style="color:#6b7280;font-size:11px;">ID: {{ $match->user_two_id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="background:rgba(168,85,247,0.15);color:#c084fc;padding:3px 10px;border-radius:20px;font-size:12px;font-weight:600;">
                            {{ $match->message_count }}
                        </span>
                    </td>
                    <td style="max-width:200px;">
                        @if($match->last_message)
                            <div style="color:#9ca3af;font-size:12px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                {{ Str::limit($match->last_message->body, 40) }}
                            </div>
                            <div style="color:#6b7280;font-size:11px;">{{ $match->last_message_at?->diffForHumans() }}</div>
                        @else
                            <span style="color:#6b7280;font-size:12px;">No messages yet</span>
                        @endif
                    </td>
                    <td style="color:#6b7280;font-size:12px;">{{ $match->matched_at?->format('M d, Y') ?? 'N/A' }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.chat.show', $match->id) }}" title="View Chat"
                                style="background:rgba(59,130,246,0.15);color:#60a5fa;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('admin.chat.destroy', $match->id) }}" method="POST"
                                onsubmit="return confirm('Delete this chat room and ALL its messages?');">
                                @csrf @method('DELETE')
                                <button type="submit" title="Delete Chat"
                                    style="background:rgba(239,68,68,0.15);color:#f87171;padding:6px 12px;border-radius:8px;font-size:12px;border:none;cursor:pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:#6b7280;">
                        <i class="fas fa-comments" style="font-size:32px;margin-bottom:10px;display:block;color:#4b5563;"></i>
                        No chat conversations found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($matches->hasPages())
    <div style="padding:16px 0 0;display:flex;justify-content:center;">
        {{ $matches->links() }}
    </div>
    @endif
</div>
@endsection
