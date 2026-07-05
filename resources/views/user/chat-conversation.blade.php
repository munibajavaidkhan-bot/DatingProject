{{-- resources/views/user/chat-conversation.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Chat with ' . $otherUser->name)
@section('page-title', 'Messages')

@section('content')

<div style="display:grid;grid-template-columns:320px 1fr;gap:20px;height:calc(100vh - 140px);min-height:500px;">

    {{-- Sidebar: Conversations --}}
    <div class="glass-card" style="padding:0;overflow:hidden;display:flex;flex-direction:column;">
        <div style="padding:16px 20px;border-bottom:1px solid rgba(236,72,153,0.1);">
            <h6 style="font-weight:700;margin:0;color:#1f2937;">
                <i class="fas fa-comments me-2" style="color:#ec4899;"></i>Conversations
            </h6>
        </div>
        <div style="overflow-y:auto;flex:1;">
            @forelse($conversations as $conv)
            @php $cu = $conv->other_user; @endphp
            <a href="{{ route('member.chat.show', $conv->id) }}"
               style="display:flex;align-items:center;gap:12px;padding:14px 16px;border-bottom:1px solid rgba(236,72,153,0.06);text-decoration:none;background:{{ $conv->id === $match->id ? '#fdf2f8' : 'transparent' }};transition:background .15s;"
               onmouseover="if({{ $conv->id !== $match->id ? 'true' : 'false' }}) this.style.background='#f9fafb'"
               onmouseout="if({{ $conv->id !== $match->id ? 'true' : 'false' }}) this.style.background='transparent'">

                <div style="position:relative;flex-shrink:0;">
                    <img src="{{ $cu->getAvatarUrl() }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;{{ $conv->id === $match->id ? 'border:2px solid #ec4899;' : '' }}">
                    @if($conv->unread_count > 0)
                    <span style="position:absolute;top:-3px;right:-3px;background:#ef4444;color:white;font-size:10px;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid white;">
                        {{ $conv->unread_count }}
                    </span>
                    @endif
                </div>

                <div style="flex:1;min-width:0;">
                    <div style="font-weight:{{ $conv->unread_count > 0 ? '700' : '600' }};font-size:13px;color:#1f2937;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        {{ $cu->name }}
                    </div>
                    <div style="font-size:11px;color:#9ca3af;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        @if($conv->last_message)
                            {{ $conv->last_message->sender_id === $user->id ? 'You: ' : '' }}{{ \Str::limit($conv->last_message->body, 35) }}
                        @else
                            Start chatting!
                        @endif
                    </div>
                </div>

                @if($conv->last_message)
                <div style="font-size:10px;color:#9ca3af;flex-shrink:0;">
                    {{ $conv->last_message->created_at->diffForHumans(null, true) }}
                </div>
                @endif
            </a>
            @empty
            <div style="text-align:center;padding:30px;color:#9ca3af;">
                <i class="fas fa-comment-slash fa-2x mb-2 d-block"></i>
                <p style="font-size:13px;">No conversations yet</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Chat Window --}}
    <div class="glass-card" style="padding:0;overflow:hidden;display:flex;flex-direction:column;">

        {{-- Chat Header --}}
        <div style="padding:16px 20px;border-bottom:1px solid rgba(236,72,153,0.1);display:flex;align-items:center;gap:14px;">
            <div style="position:relative;">
                <img src="{{ $otherUser->getAvatarUrl() }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #ec4899;">
                <div style="position:absolute;bottom:0;right:0;width:12px;height:12px;background:#22c55e;border-radius:50%;border:2px solid white;"></div>
            </div>
            <div>
                <div style="font-weight:700;color:#1f2937;font-size:15px;">{{ $otherUser->name }}</div>
                <div style="font-size:12px;color:#22c55e;font-weight:500;">
                    <i class="fas fa-circle" style="font-size:8px;margin-right:4px;"></i>Online
                </div>
            </div>
            <div style="margin-left:auto;display:flex;gap:8px;">
                <a href="{{ route('profile.show', $otherUser->id) }}"
                   style="width:36px;height:36px;border-radius:50%;background:#fce7f3;display:flex;align-items:center;justify-content:center;color:#ec4899;text-decoration:none;font-size:14px;"
                   title="View Profile">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>

        {{-- Messages --}}
        <div id="messagesContainer" style="flex:1;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;">
            @php $prevDate = null; @endphp
            @foreach($messages as $msg)

            @php $msgDate = $msg->created_at->toDateString(); @endphp
            @if($msgDate !== $prevDate)
            <div style="text-align:center;margin:8px 0;">
                <span style="background:#f3f4f6;color:#9ca3af;font-size:11px;padding:4px 14px;border-radius:20px;font-weight:500;">
                    {{ $msg->created_at->isToday() ? 'Today' : ($msg->created_at->isYesterday() ? 'Yesterday' : $msg->created_at->format('M d, Y')) }}
                </span>
            </div>
            @php $prevDate = $msgDate; @endphp
            @endif

            @php $isMine = $msg->sender_id === $user->id; @endphp
            <div style="display:flex;align-items:flex-end;gap:8px;{{ $isMine ? 'flex-direction:row-reverse;' : '' }}">
                @if(!$isMine)
                <img src="{{ $otherUser->getAvatarUrl() }}" style="width:30px;height:30px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                @endif

                <div style="max-width:65%;">
                    <div style="background:{{ $isMine ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'white' }};
                                color:{{ $isMine ? 'white' : '#1f2937' }};
                                padding:12px 16px;
                                border-radius:{{ $isMine ? '18px 18px 4px 18px' : '18px 18px 18px 4px' }};
                                font-size:14px;line-height:1.5;
                                box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                        {{ $msg->body }}
                    </div>
                    <div style="font-size:11px;color:#9ca3af;margin-top:4px;{{ $isMine ? 'text-align:right;' : '' }}">
                        {{ $msg->created_at->format('H:i') }}
                        @if($isMine)
                        <i class="fas fa-check-double ms-1" style="color:{{ $msg->is_read ? '#3b82f6' : '#9ca3af' }};"></i>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <div id="messagesEnd"></div>
        </div>

        {{-- Message Input --}}
        <div style="padding:16px 20px;border-top:1px solid rgba(236,72,153,0.1);">
            <form id="messageForm" style="display:flex;gap:10px;align-items:center;">
                @csrf
                <input type="text" id="messageInput" placeholder="Type a message..."
                       style="flex:1;padding:12px 18px;border-radius:25px;border:1.5px solid rgba(236,72,153,0.2);font-size:14px;outline:none;background:white;transition:border-color .2s;"
                       onfocus="this.style.borderColor='#ec4899'"
                       onblur="this.style.borderColor='rgba(236,72,153,0.2)'" />
                <button type="submit" class="btn-gradient" style="width:46px;height:46px;border-radius:50%;padding:0;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-paper-plane" style="font-size:16px;"></i>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const matchId      = {{ $match->id }};
    const currentUserId= {{ $user->id }};
    const sendUrl      = "{{ route('member.chat.send', $match->id) }}";
    const csrfToken    = document.querySelector('meta[name="csrf-token"]').content;

    // Scroll to bottom
    function scrollToBottom() {
        const el = document.getElementById('messagesEnd');
        el?.scrollIntoView({ behavior: 'smooth' });
    }

    scrollToBottom();

    // Send Message
    document.getElementById('messageForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const input = document.getElementById('messageInput');
        const body  = input.value.trim();
        if (!body) return;

        input.value = '';
        input.focus();

        try {
            const res  = await fetch(sendUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ body })
            });

            const data = await res.json();
            if (data.success) appendMessage(data.message, true);
        } catch(err) {
            console.error('Send failed:', err);
        }
    });

    function appendMessage(msg, isMine) {
        const container = document.getElementById('messagesContainer');
        const end       = document.getElementById('messagesEnd');
        const el        = document.createElement('div');

        el.style.cssText = `display:flex;align-items:flex-end;gap:8px;${isMine ? 'flex-direction:row-reverse;' : ''}`;
        el.innerHTML = `
            <div style="max-width:65%;">
                <div style="background:${isMine ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'white'};
                            color:${isMine ? 'white' : '#1f2937'};
                            padding:12px 16px;
                            border-radius:${isMine ? '18px 18px 4px 18px' : '18px 18px 18px 4px'};
                            font-size:14px;line-height:1.5;box-shadow:0 2px 8px rgba(0,0,0,0.08);">
                    ${msg.body}
                </div>
                <div style="font-size:11px;color:#9ca3af;margin-top:4px;${isMine ? 'text-align:right;' : ''}">
                    ${msg.created_at}
                    ${isMine ? '<i class="fas fa-check-double ms-1" style="color:#9ca3af;"></i>' : ''}
                </div>
            </div>
        `;

        container.insertBefore(el, end);
        scrollToBottom();
    }

    // Polling for new messages every 10 seconds
    let lastMessageId = {{ $messages->last()?->id ?? 0 }};

    async function pollMessages() {
        try {
            const res  = await fetch(`/member/chat/${matchId}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            });
            // Basic fallback — in production use Reverb WebSockets
        } catch(e) {}
    }

    // Enter to send
    document.getElementById('messageInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('messageForm').dispatchEvent(new Event('submit'));
        }
    });
</script>
@endpush