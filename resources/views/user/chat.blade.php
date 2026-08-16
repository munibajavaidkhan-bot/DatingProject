{{-- resources/views/user/chat.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Messages')
@section('page-title', 'Messages')

@section('content')

<div style="display:grid;grid-template-columns:320px 1fr;gap:20px;height:calc(100vh - 160px);min-height:500px;">

    {{-- ── LEFT: Conversations Sidebar ── --}}
    <div class="glass-card" style="padding:0;overflow:hidden;display:flex;flex-direction:column;">

        {{-- Sidebar Header --}}
        <div style="padding:16px 20px;border-bottom:1px solid rgba(236,72,153,0.1);">
            <h6 style="font-weight:700;margin:0;color:#1f2937;font-size:15px;">
                <i class="fas fa-comments me-2" style="color:#ec4899;"></i>
                Conversations
                @if($totalUnread > 0)
                <span style="background:#ef4444;color:white;font-size:10px;font-weight:700;padding:2px 7px;border-radius:20px;margin-left:6px;">
                    {{ $totalUnread }}
                </span>
                @endif
            </h6>
        </div>

        {{-- Conversation List --}}
        <div style="overflow-y:auto;flex:1;">
            @forelse($conversations as $conv)
            @php $cu = $conv->other_user; @endphp
            <a href="{{ route('member.chat.show', $conv->id) }}"
               style="display:flex;align-items:center;gap:12px;padding:14px 16px;
                      border-bottom:1px solid rgba(236,72,153,0.06);
                      text-decoration:none;
                      background:{{ isset($activeMatch) && $activeMatch?->id === $conv->id ? '#fdf2f8' : 'transparent' }};
                      transition:background .15s;"
               onmouseover="if({{ isset($activeMatch) && $activeMatch?->id === $conv->id ? 'false' : 'true' }}) this.style.background='#f9fafb'"
               onmouseout="if({{ isset($activeMatch) && $activeMatch?->id === $conv->id ? 'false' : 'true' }}) this.style.background='transparent'">

                {{-- Avatar --}}
                <div style="position:relative;flex-shrink:0;">
                    <img src="{{ $cu->getAvatarUrl() }}"
                         style="width:46px;height:46px;border-radius:50%;object-fit:cover;
                                {{ isset($activeMatch) && $activeMatch?->id === $conv->id ? 'border:2px solid #ec4899;' : 'border:2px solid #f3f4f6;' }}">
                    @if($conv->unread_count > 0)
                    <span style="position:absolute;top:-3px;right:-3px;background:#ef4444;color:white;font-size:10px;font-weight:700;width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;border:2px solid white;">
                        {{ $conv->unread_count > 9 ? '9+' : $conv->unread_count }}
                    </span>
                    @endif
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:{{ $conv->unread_count > 0 ? '700' : '600' }};font-size:13px;color:#1f2937;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        {{ $cu->name }}
                    </div>
                    <div style="font-size:11px;color:#9ca3af;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        @if($conv->last_message)
                            {{ $conv->last_message->sender_id === $user->id ? 'You: ' : '' }}{{ \Str::limit($conv->last_message->body, 30) }}
                        @else
                            Start chatting! 👋
                        @endif
                    </div>
                </div>

                {{-- Time --}}
                @if($conv->last_message)
                <div style="font-size:10px;color:#9ca3af;flex-shrink:0;">
                    {{ $conv->last_message->created_at->diffForHumans(null, true) }}
                </div>
                @endif
            </a>
            @empty
            <div style="text-align:center;padding:40px 20px;color:#9ca3af;">
                <i class="fas fa-comment-slash fa-2x mb-3 d-block" style="color:#fca5a5;"></i>
                <p style="font-size:13px;font-weight:600;color:#6b7280;margin-bottom:6px;">No conversations yet</p>
                <p style="font-size:12px;">Accept a match to start chatting!</p>
                <a href="{{ route('member.matches') }}"
                   style="display:inline-block;margin-top:10px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;padding:8px 18px;border-radius:10px;font-size:12px;font-weight:600;text-decoration:none;">
                    View Matches
                </a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ── RIGHT: Chat Window ── --}}
    <div class="glass-card" style="padding:0;overflow:hidden;display:flex;flex-direction:column;">

        @if($activeMatch && $otherUser)
        {{-- ── Active Conversation ── --}}

        {{-- Chat Header --}}
        <div style="padding:16px 20px;border-bottom:1px solid rgba(236,72,153,0.1);display:flex;align-items:center;gap:14px;">
            <div style="position:relative;">
                <img src="{{ $otherUser->getAvatarUrl() }}"
                     style="width:46px;height:46px;border-radius:50%;object-fit:cover;border:2px solid #ec4899;">
                <div style="position:absolute;bottom:0;right:0;width:12px;height:12px;background:#22c55e;border-radius:50%;border:2px solid white;"></div>
            </div>
            <div>
                <div style="font-weight:700;color:#1f2937;font-size:15px;">{{ $otherUser->name }}</div>
                <div style="font-size:12px;color:#6b7280;">
                    {{ $otherUser->profile?->city ?? '' }}
                    {{ $otherUser->getAge() ? '· ' . $otherUser->getAge() . ' yrs' : '' }}
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

        {{-- Messages Container --}}
        <div id="messagesContainer"
             style="flex:1;overflow-y:auto;padding:20px;display:flex;flex-direction:column;gap:12px;">

            {{-- Safety Tips Banner --}}
            <div id="safetyTipBanner" style="background:linear-gradient(135deg,#ecfdf5,#d1fae5);border:1px solid #a7f3d0;border-radius:14px;padding:12px 16px;display:flex;align-items:center;gap:12px;animation:slideDown .4s ease;">
                <div style="width:32px;height:32px;background:#22c55e;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas fa-shield-halved" style="color:white;font-size:14px;"></i>
                </div>
                <div style="flex:1;">
                    <div style="color:#065f46;font-size:13px;font-weight:700;">Safety Tip</div>
                    <div id="safetyTipText" style="color:#047857;font-size:12px;line-height:1.4;"></div>
                </div>
                <button onclick="this.closest('#safetyTipBanner').style.display='none'" style="background:none;border:none;color:#059669;cursor:pointer;font-size:14px;padding:4px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @if($messages->isEmpty())
            <div style="flex:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#9ca3af;">
                <i class="fas fa-heart fa-2x mb-3" style="color:#fca5a5;"></i>
                <p style="font-size:14px;font-weight:600;color:#6b7280;margin-bottom:4px;">Start the conversation!</p>
                <p style="font-size:12px;">Say hello to {{ $otherUser->name }} 👋</p>
            </div>
            @else

            @php $prevDate = null; @endphp
            @foreach($messages as $msg)

            {{-- Date separator --}}
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

                {{-- Avatar --}}
                @if(!$isMine)
                <img src="{{ $otherUser->getAvatarUrl() }}"
                     style="width:30px;height:30px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                @endif

                {{-- Bubble --}}
                <div style="max-width:65%;">
                    <div style="background:{{ $isMine ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'white' }};
                                color:{{ $isMine ? 'white' : '#1f2937' }};
                                padding:12px 16px;
                                border-radius:{{ $isMine ? '18px 18px 4px 18px' : '18px 18px 18px 4px' }};
                                font-size:14px;
                                line-height:1.5;
                                box-shadow:0 2px 8px rgba(0,0,0,0.08);
                                word-break:break-word;
                                position:relative;">
                        {{ $msg->body }}

                        {{-- Reaction toggle button --}}
                        <div style="position:absolute;bottom:-8px;{{ $isMine ? 'left:8px;' : 'right:8px;' }}">
                            <button onclick="showReactionPicker({{ $msg->id }}, this)"
                                    style="width:24px;height:24px;border-radius:50%;background:white;border:1px solid #e5e7eb;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:12px;box-shadow:0 1px 3px rgba(0,0,0,0.1);transition:transform .15s;"
                                    onmouseover="this.style.transform='scale(1.15)'"
                                    onmouseout="this.style.transform='scale(1)'">
                                😊
                            </button>
                        </div>
                    </div>

                    {{-- Reactions display --}}
                    <div id="reactions-{{ $msg->id }}" style="display:flex;gap:4px;flex-wrap:wrap;margin-top:6px;{{ $isMine ? 'justify-content:flex-end;' : '' }}">
                        @foreach($msg->reactions->groupBy('emoji') as $emoji => $group)
                        <span onclick="toggleReaction({{ $msg->id }}, '{{ $emoji }}')"
                              style="background:{{ $group->pluck('user_id')->contains($user->id) ? '#fce7f3' : '#f3f4f6' }};
                                     padding:2px 8px;border-radius:12px;font-size:12px;cursor:pointer;
                                     border:1px solid {{ $group->pluck('user_id')->contains($user->id) ? '#ec4899' : '#e5e7eb' }};">
                            {{ $emoji }} {{ $group->count() > 1 ? $group->count() : '' }}
                        </span>
                        @endforeach
                    </div>

                    <div style="font-size:11px;color:#9ca3af;margin-top:4px;{{ $isMine ? 'text-align:right;' : '' }}">
                        {{ $msg->created_at->format('H:i') }}
                        @if($isMine)
                        <i class="fas fa-check-double ms-1"
                           style="color:{{ $msg->is_read ? '#3b82f6' : '#9ca3af' }};"></i>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @endif

            <div id="messagesEnd"></div>
        </div>

        {{-- Message Input --}}
        <div style="padding:16px 20px;border-top:1px solid rgba(236,72,153,0.1);background:white;">
            <form id="messageForm" style="display:flex;gap:10px;align-items:center;">
                @csrf
                <input type="text" id="messageInput"
                       placeholder="Type a message to {{ $otherUser->name }}..."
                       autocomplete="off"
                       style="flex:1;padding:12px 18px;border-radius:25px;border:1.5px solid rgba(236,72,153,0.2);font-size:14px;outline:none;background:white;transition:border-color .2s;font-family:'Inter',sans-serif;"
                       onfocus="this.style.borderColor='#ec4899'"
                       onblur="this.style.borderColor='rgba(236,72,153,0.2)'" />

                <button type="submit"
                        style="width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);border:none;color:white;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;transition:transform .2s;box-shadow:0 4px 12px rgba(236,72,153,0.3);"
                        onmouseover="this.style.transform='scale(1.05)'"
                        onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-paper-plane" style="font-size:16px;"></i>
                </button>
            </form>
        </div>

        @else
        {{-- ── No Conversation Selected ── --}}
        <div style="flex:1;display:flex;align-items:center;justify-content:center;flex-direction:column;color:#9ca3af;padding:40px;">
            <div style="width:80px;height:80px;background:linear-gradient(135deg,#fce7f3,#f3e8ff);border-radius:50%;display:flex;align-items:center;justify-content:center;margin-bottom:20px;">
                <i class="fas fa-comment-dots fa-2x" style="color:#ec4899;"></i>
            </div>
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:8px;">Your Messages</h5>
            <p style="font-size:14px;text-align:center;max-width:300px;line-height:1.6;margin-bottom:20px;">
                Select a conversation from the left to start chatting, or accept a match first.
            </p>

            @if($conversations->isEmpty())
            <a href="{{ route('member.matches') }}"
               style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;padding:12px 24px;border-radius:14px;font-size:14px;font-weight:700;text-decoration:none;">
                <i class="fas fa-heart me-2"></i>Find Matches
            </a>
            @endif
        </div>
        @endif

    </div>
</div>

@endsection

@push('scripts')
@if($activeMatch && $otherUser)
<script>
    const matchId       = {{ $activeMatch->id }};
    const currentUserId = {{ $user->id }};
    const sendUrl       = "{{ route('member.chat.send', $activeMatch->id) }}";
    const csrfToken     = document.querySelector('meta[name="csrf-token"]').content;

    // ── Scroll to bottom ─────────────────────────────────────
    function scrollToBottom(smooth = true) {
        const el = document.getElementById('messagesEnd');
        el?.scrollIntoView({ behavior: smooth ? 'smooth' : 'auto' });
    }

    // On load scroll to bottom instantly
    scrollToBottom(false);

    // ── Send Message ─────────────────────────────────────────
    document.getElementById('messageForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const input = document.getElementById('messageInput');
        const body  = input.value.trim();
        if (!body) return;

        // Clear input immediately
        input.value = '';
        input.focus();

        // Optimistic UI — show message instantly
        appendMessage({
            body,
            sender_id:  currentUserId,
            created_at: new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false }),
            is_read:    false,
        }, true);

        try {
            const res  = await fetch(sendUrl, {
                method:  'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept':       'application/json',
                },
                body: JSON.stringify({ body })
            });

            const data = await res.json();
            if (!data.success) {
                console.error('Send failed:', data);
            }
        } catch(err) {
            console.error('Network error:', err);
        }
    });

    // ── Append Message to UI ─────────────────────────────────
    function appendMessage(msg, isMine) {
        const container = document.getElementById('messagesContainer');
        const end       = document.getElementById('messagesEnd');

        const el = document.createElement('div');
        el.style.cssText = `display:flex;align-items:flex-end;gap:8px;${isMine ? 'flex-direction:row-reverse;' : ''}`;

        el.innerHTML = `
            <div style="max-width:65%;">
                <div style="background:${isMine ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'white'};
                            color:${isMine ? 'white' : '#1f2937'};
                            padding:12px 16px;
                            border-radius:${isMine ? '18px 18px 4px 18px' : '18px 18px 18px 4px'};
                            font-size:14px;line-height:1.5;
                            box-shadow:0 2px 8px rgba(0,0,0,0.08);
                            word-break:break-word;">
                    ${escapeHtml(msg.body)}
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

    // ── Escape HTML (XSS prevention) ─────────────────────────
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.appendChild(document.createTextNode(text));
        return div.innerHTML;
    }

    // ── Enter key to send ────────────────────────────────────
    document.getElementById('messageInput').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('messageForm').dispatchEvent(new Event('submit'));
        }
    });

    // ── Poll for new messages every 5 seconds ────────────────
    let lastMessageTime = '{{ $messages->last()?->created_at?->toISOString() ?? now()->toISOString() }}';

    async function pollNewMessages() {
        try {
            const res  = await fetch(`{{ route('member.chat.poll', $activeMatch->id) }}?after=${lastMessageTime}`, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });

            if (!res.ok) return;
            const data = await res.json();

            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(msg => {
                    if (msg.sender_id !== currentUserId) {
                        appendMessage(msg, false);
                    }
                });
                lastMessageTime = data.messages[data.messages.length - 1].created_at_iso;

                // Mark as read
                fetch('{{ route("member.chat.read", $activeMatch->id) }}', {
                    method:  'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                });
            }
        } catch(e) {
            // Silent fail
        }
    }

    setInterval(pollNewMessages, 5000);
</script>
@endif
@endpush

{{-- Safety Disclaimer Modal --}}
@if(!$user->safety_disclaimer_accepted)
<div id="safetyModal" style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:20px;padding:36px;max-width:480px;width:90%;box-shadow:0 25px 60px rgba(0,0,0,0.3);">
        <div style="text-align:center;margin-bottom:20px;">
            <div style="width:64px;height:64px;border-radius:50%;background:rgba(239,68,68,0.1);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <i class="fas fa-shield-halved" style="font-size:28px;color:#ef4444;"></i>
            </div>
            <h3 style="color:#1f2937;font-size:20px;font-weight:700;margin-bottom:8px;">Safety Disclaimer</h3>
            <p style="color:#6b7280;font-size:13px;">Please read carefully before using chat</p>
        </div>

        <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:16px;margin-bottom:20px;">
            <ul style="color:#991b1b;font-size:13px;line-height:1.8;padding-left:18px;margin:0;">
                <li><strong>Never share</strong> personal addresses, phone numbers, or financial information</li>
                <li><strong>Never meet</strong> someone in a private or isolated location for the first time</li>
                <li><strong>Always meet</strong> in a public place and tell a friend or family member your plans</li>
                <li><strong>Trust your instincts</strong> — if something feels wrong, it probably is</li>
                <li><strong>Report suspicious behavior</strong> immediately to our support team</li>
            </ul>
        </div>

        <div style="display:flex;align-items:start;gap:10px;margin-bottom:20px;">
            <input type="checkbox" id="safetyCheck" style="accent-color:#ec4899;margin-top:3px;">
            <label for="safetyCheck" style="color:#374151;font-size:13px;line-height:1.5;">
                I have read and understood the safety guidelines. I agree to follow them when communicating with other users.
            </label>
        </div>

        <button id="acceptDisclaimer" disabled style="width:100%;padding:12px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;font-size:14px;font-weight:600;cursor:pointer;opacity:0.5;">
            <i class="fas fa-check me-1"></i> I Understand & Agree
        </button>
    </div>
</div>

<script>
    const check = document.getElementById('safetyCheck');
    const btn = document.getElementById('acceptDisclaimer');
    const modal = document.getElementById('safetyModal');

    check.addEventListener('change', () => {
        btn.disabled = !check.checked;
        btn.style.opacity = check.checked ? '1' : '0.5';
    });

    btn.addEventListener('click', async () => {
        const token = document.querySelector('meta[name="csrf-token"]').content;
        const res = await fetch('{{ route("member.chat.accept-disclaimer") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
        });
        if (res.ok) {
            modal.style.display = 'none';
        }
    });
</script>
@endif

<script>
const REACTION_EMOJIS = ['❤️','😂','👍','😮','😢','🔥'];
let activePicker = null;

function showReactionPicker(messageId, btn) {
    closePickers();
    const picker = document.createElement('div');
    picker.style.cssText = 'position:absolute;bottom:32px;left:50%;transform:translateX(-50%);background:white;border-radius:24px;box-shadow:0 4px 20px rgba(0,0,0,0.18);padding:6px 10px;display:flex;gap:4px;z-index:100;';
    REACTION_EMOJIS.forEach(e => {
        const s = document.createElement('span');
        s.textContent = e;
        s.style.cssText = 'font-size:20px;cursor:pointer;padding:4px;border-radius:8px;transition:transform .15s;display:flex;align-items:center;justify-content:center;width:32px;height:32px;';
        s.onmouseover = () => s.style.transform = 'scale(1.3)';
        s.onmouseout  = () => s.style.transform = 'scale(1)';
        s.onclick = ev => { ev.stopPropagation(); toggleReaction(messageId, e); closePickers(); };
        picker.appendChild(s);
    });
    btn.closest('div[style*="position:relative"]') || (btn.parentElement.style.position = 'relative');
    btn.parentElement.appendChild(picker);
    activePicker = picker;
    setTimeout(() => document.addEventListener('click', closePickers, { once: true }), 10);
}
function closePickers() { if (activePicker) { activePicker.remove(); activePicker = null; } }

async function toggleReaction(messageId, emoji) {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    await fetch('/member/chat/message/' + messageId + '/reaction', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': token, 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ emoji }),
    });
    loadReactions(messageId);
}

async function loadReactions(messageId) {
    const res = await fetch('/member/chat/message/' + messageId + '/reactions');
    if (!res.ok) return;
    const data = await res.json();
    const el = document.getElementById('reactions-' + messageId);
    if (!el) return;
    el.innerHTML = '';
    Object.values(data.reactions).forEach(r => {
        const sp = document.createElement('span');
        sp.textContent = r.emoji + (r.count > 1 ? ' ' + r.count : '');
        sp.onclick = () => toggleReaction(messageId, r.emoji);
        sp.style.cssText = 'background:#f3f4f6;padding:2px 8px;border-radius:12px;font-size:12px;cursor:pointer;border:1px solid #e5e7eb;';
        el.appendChild(sp);
    });
}

// ── Safety Tips Rotation ─────────────────────────────────────
const SAFETY_TIPS = [
    "Never share personal financial information with someone you haven't met in person.",
    "Meet in a public place for your first few dates and tell a friend where you're going.",
    "Trust your instincts — if something feels off, it probably is.",
    "Take your time getting to know someone before sharing your phone number or address.",
    "Report any suspicious behavior to our support team immediately.",
    "Use our video chat feature before meeting in person to verify they're real.",
    "Keep conversations on the platform until you feel comfortable moving to another channel.",
    "Be cautious of anyone who declares strong feelings very quickly.",
];
let tipIndex = 0;

function rotateSafetyTip() {
    const el = document.getElementById('safetyTipText');
    if (!el) return;
    el.style.opacity = '0';
    setTimeout(() => {
        el.textContent = SAFETY_TIPS[tipIndex];
        el.style.opacity = '1';
        tipIndex = (tipIndex + 1) % SAFETY_TIPS.length;
    }, 300);
}
rotateSafetyTip();
setInterval(rotateSafetyTip, 8000);

// ── Slow Scroll Notification ─────────────────────────────────
let scrollTimeout;
const msgContainer = document.getElementById('messagesContainer');
if (msgContainer) {
    msgContainer.addEventListener('scroll', () => {
        clearTimeout(scrollTimeout);
        msgContainer.style.scrollBehavior = 'smooth';
    });
}

// ── Typing indicator (shows when composing) ──────────────────
const msgInput = document.getElementById('messageInput');
let typingTimeout;
if (msgInput) {
    msgInput.addEventListener('input', () => {
        clearTimeout(typingTimeout);
        // Could broadcast typing event here in future
        typingTimeout = setTimeout(() => {}, 1000);
    });
}
</script>

<style>
@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>