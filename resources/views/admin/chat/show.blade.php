@extends('layouts.admin-layout')

@section('title', 'Chat Conversation')
@section('page-title', 'Chat — ' . $match->userOne->name . ' & ' . $match->userTwo->name)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div style="display:flex;align-items:center;gap:16px;">
        <a href="{{ route('admin.chat.index') }}" style="color:#9ca3af;text-decoration:none;font-size:13px;">
            <i class="fas fa-arrow-left me-1"></i> Back to Chat List
        </a>
    </div>
    <div style="display:flex;gap:8px;">
        <span style="background:rgba(168,85,247,0.15);color:#c084fc;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;">
            {{ $messageCount }} messages
        </span>
    </div>
</div>

<div style="display:grid;grid-template-columns:280px 1fr;gap:0;border:1px solid rgba(255,255,255,0.06);border-radius:16px;overflow:hidden;background:#1a1a24;">

    {{-- User Info Sidebar --}}
    <div style="border-right:1px solid rgba(255,255,255,0.06);padding:20px;">
        <div style="text-align:center;margin-bottom:20px;">
            <div style="display:flex;justify-content:center;gap:-10px;margin-bottom:12px;">
                <img src="{{ $match->userOne->getAvatarUrl() }}" alt="" style="width:56px;height:56px;border-radius:50%;border:3px solid #1a1a24;object-fit:cover;">
                <img src="{{ $match->userTwo->getAvatarUrl() }}" alt="" style="width:56px;height:56px;border-radius:50%;border:3px solid #1a1a24;object-fit:cover;margin-left:-16px;">
            </div>
            <div style="color:#e5e7eb;font-weight:700;font-size:14px;">{{ $match->userOne->name }}</div>
            <div style="color:#6b7280;font-size:12px;">&amp;</div>
            <div style="color:#e5e7eb;font-weight:700;font-size:14px;">{{ $match->userTwo->name }}</div>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,0.06);padding-top:16px;">
            <div style="font-size:11px;color:#6b7280;text-transform:uppercase;font-weight:700;margin-bottom:10px;">Chat Details</div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#9ca3af;font-size:12px;">Status</span>
                <span style="color:#34d399;font-size:12px;font-weight:600;">Accepted</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#9ca3af;font-size:12px;">Matched</span>
                <span style="color:#e5e7eb;font-size:12px;">{{ $match->matched_at?->format('M d, Y') ?? 'N/A' }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                <span style="color:#9ca3af;font-size:12px;">Compatibility</span>
                <span style="color:#e5e7eb;font-size:12px;">{{ $match->compatibility_score ?? 0 }}%</span>
            </div>
            <div style="display:flex;justify-content:space-between;">
                <span style="color:#9ca3af;font-size:12px;">Last Message</span>
                <span style="color:#e5e7eb;font-size:12px;">{{ $match->last_message_at?->diffForHumans() ?? 'Never' }}</span>
            </div>
        </div>

        <div style="border-top:1px solid rgba(255,255,255,0.06);padding-top:16px;margin-top:16px;">
            <a href="{{ route('admin.users.show', $match->user_one_id) }}" style="display:block;text-align:center;background:rgba(59,130,246,0.15);color:#60a5fa;padding:8px;border-radius:10px;font-size:12px;text-decoration:none;margin-bottom:8px;">
                <i class="fas fa-user me-1"></i> View {{ $match->userOne->name }}
            </a>
            <a href="{{ route('admin.users.show', $match->user_two_id) }}" style="display:block;text-align:center;background:rgba(59,130,246,0.15);color:#60a5fa;padding:8px;border-radius:10px;font-size:12px;text-decoration:none;">
                <i class="fas fa-user me-1"></i> View {{ $match->userTwo->name }}
            </a>
        </div>
    </div>

    {{-- Messages Area --}}
    <div style="display:flex;flex-direction:column;max-height:600px;">
        <div id="chat-messages" style="flex:1;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;">
            @forelse($messages as $msg)
                @php $isAdmin = false; @endphp
                <div style="display:flex;gap:10px;{{ $msg->sender_id == $match->user_one_id ? '' : 'flex-direction:row-reverse;' }}">
                    <img src="{{ $msg->sender->getAvatarUrl() }}" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                    <div style="max-width:70%;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;{{ $msg->sender_id == $match->user_one_id ? '' : 'flex-direction:row-reverse;' }}">
                            <span style="color:#e5e7eb;font-size:12px;font-weight:600;">{{ $msg->sender->name }}</span>
                            <span style="color:#6b7280;font-size:10px;">{{ $msg->created_at->format('M d, H:i') }}</span>
                            @if($msg->is_read)
                                <span style="color:#60a5fa;font-size:10px;"><i class="fas fa-check-double"></i></span>
                            @endif
                        </div>
                        <div style="background:{{ $msg->sender_id == $match->user_one_id ? 'rgba(236,72,153,0.15)' : 'rgba(168,85,247,0.15)' }};padding:10px 14px;border-radius:14px;{{ $msg->sender_id == $match->user_one_id ? 'border-top-left-radius:4px;' : 'border-top-right-radius:4px;' }}">
                            <p style="margin:0;color:#d1d5db;font-size:13px;line-height:1.5;">{{ $msg->body }}</p>
                        </div>
                        <form action="{{ route('admin.chat.message.destroy', $msg->id) }}" method="POST" style="margin-top:4px;{{ $msg->sender_id == $match->user_one_id ? '' : 'text-align:right;' }}">
                            @csrf @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this message?')" style="background:none;border:none;color:#6b7280;font-size:10px;cursor:pointer;padding:2px 6px;">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="text-align:center;padding:40px;color:#6b7280;">
                    <i class="fas fa-comment-slash" style="font-size:28px;margin-bottom:10px;display:block;"></i>
                    No messages in this conversation.
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chat-messages');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection
