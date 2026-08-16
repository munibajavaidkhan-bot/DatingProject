{{-- resources/views/user/discover.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Discover')
@section('page-title', 'Discover')

@section('content')

{{-- Stats Bar --}}
<div class="row g-3 mb-4">
@foreach([
    ['💕', 'Likes Sent',     $stats['daily_likes_used'] . '/' . $stats['daily_likes_limit'] . ' today',  '#ec4899', '#fce7f3'],
    ['❤️', 'Likes Received', $stats['likes_received'], '#a855f7', '#f3e8ff'],
    ['🎉', 'Matches',        $stats['mutual_matches'],  '#22c55e', '#dcfce7'],
    ['⭐', 'Super Likes',    $stats['super_likes_left'] . ' left today','#f59e0b', '#fef3c7'],
] as [$emoji, $label, $value, $color, $bg])
    <div class="col-6 col-md-3">
        <div class="glass-card text-center" style="padding:16px;">
            <div style="font-size:24px;margin-bottom:6px;">{{ $emoji }}</div>
            <div style="font-size:22px;font-weight:800;color:{{ $color }};">{{ $value }}</div>
            <div style="font-size:11px;color:#9ca3af;font-weight:600;">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

<div class="row g-4">

    {{-- LEFT: Swipe Cards --}}
    <div class="col-lg-7">
        <div class="glass-card" style="padding:24px;">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                <h5 style="font-weight:700;color:#1f2937;margin:0;">
                    <i class="fas fa-fire me-2" style="color:#ec4899;"></i>
                    Discover People
                </h5>
                <span style="font-size:13px;color:#9ca3af;">
                    {{ $profiles->count() }} profiles
                </span>
            </div>

            @if($profiles->isEmpty())
            {{-- No More Profiles --}}
            <div style="text-align:center;padding:60px 20px;">
                <div style="font-size:64px;margin-bottom:16px;">🎉</div>
                <h5 style="font-weight:700;color:#1f2937;margin-bottom:8px;">
                    You've seen everyone!
                </h5>
                <p style="color:#6b7280;font-size:14px;margin-bottom:20px;">
                    Check back later for new profiles, or update your preferences.
                </p>
                <a href="{{ route('profile.edit') }}"
                   style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;padding:12px 24px;border-radius:14px;text-decoration:none;font-weight:700;font-size:14px;">
                    Update Preferences
                </a>
            </div>

            @else
            {{-- Swipe Stack --}}
            <div id="cardStack" style="position:relative;height:520px;">
                @foreach($profiles as $index => $profile)
                <div class="swipe-card"
                     id="card-{{ $profile->id }}"
                     data-user-id="{{ $profile->id }}"
                     style="position:absolute;inset:0;
                            background:white;
                            border-radius:24px;
                            overflow:hidden;
                            box-shadow:0 8px 32px rgba(0,0,0,0.12);
                            cursor:grab;
                            transition:transform .1s;
                            z-index:{{ $profiles->count() - $index }};
                            transform:scale({{ 1 - ($index * 0.04) }}) translateY({{ $index * 8 }}px);
                            {{ $index > 2 ? 'display:none;' : '' }}">

                    {{-- Card Photo --}}
                    <div style="height:340px;position:relative;overflow:hidden;background:linear-gradient(135deg,#fce7f3,#f3e8ff);">
                        <img src="{{ $profile->getAvatarUrl() }}"
                             style="width:100%;height:100%;object-fit:cover;">

                        {{-- Gradient overlay --}}
                        <div style="position:absolute;bottom:0;left:0;right:0;height:160px;background:linear-gradient(transparent,rgba(0,0,0,0.7));"></div>

                        {{-- Like/Nope indicators --}}
                        <div id="likeIndicator-{{ $profile->id }}"
                             style="position:absolute;top:20px;left:20px;background:#22c55e;color:white;font-size:20px;font-weight:900;padding:8px 18px;border-radius:10px;border:3px solid #22c55e;opacity:0;transform:rotate(-15deg);transition:opacity .2s;">
                            LIKE 💚
                        </div>
                        <div id="nopeIndicator-{{ $profile->id }}"
                             style="position:absolute;top:20px;right:20px;background:#ef4444;color:white;font-size:20px;font-weight:900;padding:8px 18px;border-radius:10px;border:3px solid #ef4444;opacity:0;transform:rotate(15deg);transition:opacity .2s;">
                            NOPE ❌
                        </div>
                        <div id="superIndicator-{{ $profile->id }}"
                             style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:#f59e0b;color:white;font-size:20px;font-weight:900;padding:8px 18px;border-radius:10px;border:3px solid #f59e0b;opacity:0;transition:opacity .2s;">
                            SUPER ⭐
                        </div>

                        {{-- Name overlay --}}
                        <div style="position:absolute;bottom:16px;left:20px;right:20px;color:white;">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                                <h4 style="font-family:'Playfair Display',serif;font-size:22px;font-weight:700;margin:0;">
                                    {{ $profile->name }}
                                </h4>
                                <span style="font-size:18px;font-weight:600;opacity:0.9;">
                                    {{ $profile->getAge() }}
                                </span>
                                @if($profile->profile?->is_verified)
                                <i class="fas fa-circle-check" style="color:#60a5fa;font-size:18px;"></i>
                                @endif
                            </div>
                            <div style="font-size:13px;opacity:0.85;">
                                <i class="fas fa-location-dot me-1"></i>
                                {{ $profile->profile?->city ?? 'Unknown' }}
                                @php $dist = auth()->user()->distanceTo($profile); @endphp
                                @if($dist !== null)
                                    <span style="margin-left:6px;font-size:11px;opacity:0.7;">
                                        (<i class="fas fa-road me-1"></i>{{ round($dist) }} km)
                                    </span>
                                @endif
                                @if($profile->profile?->occupation)
                                · {{ $profile->profile->occupation }}
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Card Info --}}
                    <div style="padding:16px 20px;">
                        {{-- Personality + Goal --}}
                        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px;">
                            @if($profile->profile?->personality_type)
                            <span style="background:#fce7f3;color:#ec4899;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;">
                                {{ $profile->profile->personality_type }}
                            </span>
                            @endif
                            @if($profile->profile?->relationship_goal)
                            <span style="background:#f3e8ff;color:#a855f7;font-size:11px;font-weight:600;padding:4px 12px;border-radius:20px;">
                                {{ ucfirst(str_replace('_',' ',$profile->profile->relationship_goal)) }}
                            </span>
                            @endif
                        </div>

                        {{-- Bio --}}
                        @if($profile->profile?->bio)
                        <p style="font-size:13px;color:#6b7280;line-height:1.5;margin-bottom:12px;">
                            {{ \Str::limit($profile->profile->bio, 100) }}
                        </p>
                        @endif

                        {{-- Interests --}}
                        @if($profile->profile?->interests)
                        <div style="display:flex;gap:6px;flex-wrap:wrap;">
                            @foreach(array_slice($profile->profile->interests, 0, 5) as $interest)
                            <span style="background:#f3f4f6;color:#6b7280;font-size:11px;padding:3px 10px;border-radius:20px;">
                                {{ $interest }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Action Buttons --}}
            <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-top:20px;">

                {{-- Pass Button --}}
                <button onclick="swipeAction('pass')"
                        id="passBtn"
                        style="width:56px;height:56px;border-radius:50%;background:white;border:2px solid #fee2e2;color:#ef4444;font-size:22px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;box-shadow:0 4px 14px rgba(239,68,68,0.15);"
                        onmouseover="this.style.background='#fee2e2';this.style.transform='scale(1.1)'"
                        onmouseout="this.style.background='white';this.style.transform='scale(1)'">
                    <i class="fas fa-times"></i>
                </button>

                {{-- Super Like Button --}}
                <button onclick="swipeAction('super_like')"
                        id="superBtn"
                        style="width:48px;height:48px;border-radius:50%;background:white;border:2px solid #fef3c7;color:#f59e0b;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;box-shadow:0 4px 14px rgba(245,158,11,0.15);"
                        onmouseover="this.style.background='#fef3c7';this.style.transform='scale(1.1)'"
                        onmouseout="this.style.background='white';this.style.transform='scale(1)'">
                    <i class="fas fa-star"></i>
                </button>

                {{-- Like Button --}}
                <button onclick="swipeAction('like')"
                        id="likeBtn"
                        style="width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);border:none;color:white;font-size:22px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;box-shadow:0 4px 14px rgba(236,72,153,0.35);"
                        onmouseover="this.style.transform='scale(1.1)'"
                        onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-heart"></i>
                </button>

            </div>

            {{-- Swipe hint --}}
            <p style="text-align:center;font-size:12px;color:#9ca3af;margin-top:12px;">
                <i class="fas fa-hand-pointer me-1"></i>
                Swipe cards or use buttons · ⭐ Super Like = special interest
            </p>
            @endif
        </div>
    </div>

    {{-- RIGHT: Who Liked Me --}}
    <div class="col-lg-5">

        {{-- Pending Likes --}}
        <div class="glass-card mb-4">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <h6 style="font-weight:700;color:#1f2937;margin:0;">
                    <i class="fas fa-heart me-2" style="color:#ec4899;"></i>
                    People Who Liked You
                </h6>
                <span id="likedMeCount"
                      style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-size:12px;font-weight:700;padding:3px 10px;border-radius:20px;">
                    {{ $likedMe->count() }}
                </span>
            </div>

            @forelse($likedMe as $like)
            <div style="display:flex;align-items:center;gap:12px;padding:12px;border-radius:14px;background:#fdf2f8;margin-bottom:8px;">

                {{-- Avatar --}}
                <div style="position:relative;flex-shrink:0;">
                    <img src="{{ $like->sender->getAvatarUrl() }}"
                         style="width:50px;height:50px;border-radius:50%;object-fit:cover;border:2px solid {{ $like->type === 'super_like' ? '#f59e0b' : '#ec4899' }};">
                    @if($like->type === 'super_like')
                    <div style="position:absolute;bottom:-2px;right:-2px;width:20px;height:20px;background:#f59e0b;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-star" style="font-size:9px;color:white;"></i>
                    </div>
                    @else
                    <div style="position:absolute;bottom:-2px;right:-2px;width:20px;height:20px;background:#ec4899;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-heart" style="font-size:9px;color:white;"></i>
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:700;font-size:14px;color:#1f2937;">
                        {{ $like->sender->name }}
                    </div>
                    <div style="font-size:12px;color:#9ca3af;">
                        {{ $like->sender->getAge() ? $like->sender->getAge().' yrs' : '' }}
                        {{ $like->sender->profile?->city ? '· '.$like->sender->profile->city : '' }}
                    </div>
                    <div style="font-size:11px;color:{{ $like->type === 'super_like' ? '#f59e0b' : '#ec4899' }};font-weight:600;margin-top:2px;">
                        {{ $like->type === 'super_like' ? '⭐ Super Liked you!' : '💕 Liked you' }}
                        · {{ $like->created_at->diffForHumans() }}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div style="display:flex;flex-direction:column;gap:6px;flex-shrink:0;">
                    {{-- Like Back = Mutual Match --}}
                    <button onclick="likeBack({{ $like->sender->id }}, this)"
                            style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:7px 14px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;">
                        <i class="fas fa-heart me-1"></i>Match!
                    </button>
                    {{-- Pass --}}
                    <button onclick="passUser({{ $like->sender->id }}, this)"
                            style="background:#f3f4f6;color:#9ca3af;border:none;border-radius:10px;padding:7px 14px;font-size:12px;cursor:pointer;">
                        Pass
                    </button>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:30px;color:#9ca3af;">
                <i class="fas fa-heart fa-2x mb-3 d-block" style="color:#fca5a5;"></i>
                <p style="font-size:13px;font-weight:600;margin-bottom:4px;">No likes yet</p>
                <p style="font-size:12px;">Keep swiping to get more visibility!</p>
            </div>
            @endforelse
        </div>

        {{-- Tips Card --}}
        <div style="background:linear-gradient(135deg,#1f2937,#374151);border-radius:20px;padding:20px;color:white;">
            <h6 style="font-weight:700;margin-bottom:14px;">
                <i class="fas fa-lightbulb me-2" style="color:#f59e0b;"></i>
                How It Works
            </h6>
            @foreach([
                ['fa-heart','#ec4899','Like someone you\'re interested in'],
                ['fa-star','#f59e0b','Super Like = show extra interest'],
                ['fa-handshake','#22c55e','Both like = Mutual Match!'],
                ['fa-comments','#6366f1','Matched? Chat unlocks instantly'],
            ] as [$icon,$color,$tip])
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                <div style="width:30px;height:30px;border-radius:50%;background:{{ $color }}22;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:12px;"></i>
                </div>
                <span style="font-size:13px;opacity:0.85;">{{ $tip }}</span>
            </div>
            @endforeach
        </div>

    </div>
</div>

{{-- ── MATCH POPUP MODAL ── --}}
<div id="matchModal"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.7);z-index:99999;align-items:center;justify-content:center;">
    <div style="background:linear-gradient(135deg,#ec4899,#a855f7,#6366f1);border-radius:28px;padding:48px 36px;text-align:center;max-width:380px;width:90%;position:relative;overflow:hidden;">

        {{-- Confetti dots --}}
        <div style="position:absolute;inset:0;pointer-events:none;" id="confettiContainer"></div>

        <div style="font-size:64px;margin-bottom:12px;position:relative;z-index:1;">🎉</div>

        <h2 style="font-family:'Playfair Display',serif;color:white;font-size:28px;font-weight:700;margin-bottom:8px;position:relative;z-index:1;">
            It's a Match!
        </h2>

        <p style="color:rgba(255,255,255,0.9);font-size:15px;margin-bottom:24px;position:relative;z-index:1;">
            You and <strong id="matchName">someone</strong> liked each other!
        </p>

        {{-- Avatars --}}
        <div style="display:flex;align-items:center;justify-content:center;gap:16px;margin-bottom:28px;position:relative;z-index:1;">
            <img src="{{ auth()->user()->getAvatarUrl() }}"
                 style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid white;box-shadow:0 4px 14px rgba(0,0,0,0.2);">
            <div style="font-size:28px;">💕</div>
            <img id="matchAvatar" src=""
                 style="width:70px;height:70px;border-radius:50%;object-fit:cover;border:3px solid white;box-shadow:0 4px 14px rgba(0,0,0,0.2);">
        </div>

        {{-- Buttons --}}
        <div style="display:flex;flex-direction:column;gap:10px;position:relative;z-index:1;">
            <a id="startChatBtn" href="#"
               style="background:white;color:#ec4899;padding:14px;border-radius:14px;font-weight:800;font-size:15px;text-decoration:none;display:block;">
                <i class="fas fa-comment-dots me-2"></i>Start Chatting!
            </a>
            <button onclick="closeMatchModal()"
                    style="background:rgba(255,255,255,0.2);color:white;border:none;padding:12px;border-radius:14px;font-weight:600;font-size:14px;cursor:pointer;">
                Keep Swiping
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ── State ─────────────────────────────────────────────────
    const profiles     = @json($profiles->pluck('id'));
    let   currentIndex = 0;
    let   isDragging   = false;
    let   startX       = 0;
    let   startY       = 0;
    let   currentX     = 0;
    const csrfToken    = document.querySelector('meta[name="csrf-token"]').content;

    // ── Get Current Card ──────────────────────────────────────
    function getCurrentCard() {
        if (currentIndex >= profiles.length) return null;
        return document.getElementById('card-' + profiles[currentIndex]);
    }

    function getCurrentUserId() {
        return profiles[currentIndex];
    }

    // ── Swipe Action (buttons) ────────────────────────────────
    async function swipeAction(type) {
        const card   = getCurrentCard();
        const userId = getCurrentUserId();
        if (!card || !userId) return;

        // Show indicator
        if (type === 'like') {
            document.getElementById('likeIndicator-' + userId).style.opacity = '1';
            animateCard(card, 'right');
        } else if (type === 'pass') {
            document.getElementById('nopeIndicator-' + userId).style.opacity = '1';
            animateCard(card, 'left');
        } else if (type === 'super_like') {
            document.getElementById('superIndicator-' + userId).style.opacity = '1';
            animateCard(card, 'up');
        }

        // Send to server
        if (type === 'pass') {
            await sendPass(userId);
        } else {
            await sendLike(userId, type);
        }

        // Next card
        setTimeout(() => nextCard(card), 350);
    }

    // ── Animate Card Away ─────────────────────────────────────
    function animateCard(card, direction) {
        const transforms = {
            right: 'translateX(150%) rotate(30deg)',
            left:  'translateX(-150%) rotate(-30deg)',
            up:    'translateY(-150%) scale(0.8)',
        };
        card.style.transition = 'transform .35s ease';
        card.style.transform  = transforms[direction];
    }

    // ── Next Card ─────────────────────────────────────────────
    function nextCard(card) {
        card.style.display = 'none';
        currentIndex++;

        // Show next cards in stack
        for (let i = currentIndex; i < Math.min(currentIndex + 3, profiles.length); i++) {
            const nextCard = document.getElementById('card-' + profiles[i]);
            if (nextCard) {
                const stackPos = i - currentIndex;
                nextCard.style.display   = 'block';
                nextCard.style.transform = `scale(${1 - stackPos * 0.04}) translateY(${stackPos * 8}px)`;
                nextCard.style.zIndex    = profiles.length - i;
                nextCard.style.transition= 'transform .3s ease';
            }
        }

        if (currentIndex >= profiles.length) {
            document.getElementById('cardStack').innerHTML = `
                <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;color:#9ca3af;padding:40px;text-align:center;">
                    <div style="font-size:60px;margin-bottom:16px;">🎉</div>
                    <h5 style="font-weight:700;color:#1f2937;margin-bottom:8px;">All caught up!</h5>
                    <p style="font-size:14px;">Check back later for new people.</p>
                </div>
            `;
            disableButtons();
        }
    }

    function disableButtons() {
        ['passBtn','superBtn','likeBtn'].forEach(id => {
            const btn = document.getElementById(id);
            if (btn) { btn.disabled = true; btn.style.opacity = '0.4'; }
        });
    }

    // ── Send Like API ─────────────────────────────────────────
    async function sendLike(userId, type = 'like') {
        try {
            const res  = await fetch(`/member/like/${userId}`, {
                method:  'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept':       'application/json',
                },
                body: JSON.stringify({ type })
            });

            const data = await res.json();

            if (data.is_mutual) {
                // ── MATCH! Show popup ──────────────────────────
                setTimeout(() => showMatchModal(data), 400);
            }
        } catch(e) {
            console.error('Like error:', e);
        }
    }

    // ── Send Pass API ─────────────────────────────────────────
    async function sendPass(userId) {
        try {
            await fetch(`/member/pass/${userId}`, {
                method:  'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept':       'application/json',
                }
            });
        } catch(e) {
            console.error('Pass error:', e);
        }
    }

    // ── Like Back (from "Who Liked Me" section) ───────────────
    async function likeBack(userId, btn) {
        btn.disabled   = true;
        btn.innerHTML  = '<i class="fas fa-spinner fa-spin"></i>';

        const res  = await fetch(`/member/like/${userId}`, {
            method:  'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept':       'application/json',
            },
            body: JSON.stringify({ type: 'like' })
        });

        const data = await res.json();

        if (data.is_mutual) {
            showMatchModal(data);
            // Remove the like card
            btn.closest('div[style*="border-radius:14px"]').style.opacity = '0';
            setTimeout(() => {
                btn.closest('div[style*="border-radius:14px"]').remove();
                updateLikedCount();
            }, 300);
        }
    }

    // ── Pass User ─────────────────────────────────────────────
    async function passUser(userId, btn) {
        await sendPass(userId);
        const card = btn.closest('div[style*="border-radius:14px"]');
        card.style.opacity = '0';
        card.style.transition = 'opacity .3s';
        setTimeout(() => { card.remove(); updateLikedCount(); }, 300);
    }

    function updateLikedCount() {
        const remaining = document.querySelectorAll('[onclick^="likeBack"]').length;
        document.getElementById('likedMeCount').textContent = remaining;
    }

    // ── Match Modal ───────────────────────────────────────────
    function showMatchModal(data) {
        document.getElementById('matchName').textContent    = data.other_user.name;
        document.getElementById('matchAvatar').src          = data.other_user.avatar;
        document.getElementById('startChatBtn').href        = data.chat_url;
        document.getElementById('matchModal').style.display = 'flex';

        // Confetti animation
        createConfetti();
    }

    function closeMatchModal() {
        document.getElementById('matchModal').style.display = 'none';
    }

    // ── Confetti ──────────────────────────────────────────────
    function createConfetti() {
        const container = document.getElementById('confettiContainer');
        const colors    = ['#ec4899','#a855f7','#f59e0b','#22c55e','#6366f1','white'];

        for (let i = 0; i < 40; i++) {
            const dot = document.createElement('div');
            dot.style.cssText = `
                position:absolute;
                width:${Math.random() * 10 + 4}px;
                height:${Math.random() * 10 + 4}px;
                background:${colors[Math.floor(Math.random() * colors.length)]};
                border-radius:${Math.random() > 0.5 ? '50%' : '2px'};
                left:${Math.random() * 100}%;
                top:-20px;
                opacity:${Math.random() * 0.8 + 0.2};
                animation:fall ${Math.random() * 2 + 1}s linear ${Math.random() * 0.5}s forwards;
            `;
            container.appendChild(dot);
        }
    }

    // ── Touch/Drag Swipe ──────────────────────────────────────
    function initSwipe() {
        const card = getCurrentCard();
        if (!card) return;

        // Mouse events
        card.addEventListener('mousedown', dragStart);
        document.addEventListener('mousemove', dragMove);
        document.addEventListener('mouseup', dragEnd);

        // Touch events
        card.addEventListener('touchstart', e => dragStart(e.touches[0]));
        document.addEventListener('touchmove', e => dragMove(e.touches[0]));
        document.addEventListener('touchend', dragEnd);
    }

    function dragStart(e) {
        isDragging = true;
        startX     = e.clientX;
        startY     = e.clientY;
        const card = getCurrentCard();
        if (card) card.style.transition = 'none';
    }

    function dragMove(e) {
        if (!isDragging) return;
        currentX       = e.clientX - startX;
        const currentY = e.clientY - startY;
        const rotate   = currentX * 0.1;
        const card     = getCurrentCard();
        const userId   = getCurrentUserId();

        if (!card || !userId) return;

        card.style.transform = `translateX(${currentX}px) translateY(${currentY}px) rotate(${rotate}deg)`;

        // Show indicators
        const likeEl  = document.getElementById('likeIndicator-' + userId);
        const nopeEl  = document.getElementById('nopeIndicator-' + userId);
        const superEl = document.getElementById('superIndicator-' + userId);

        if (currentX > 60) {
            if (likeEl)  likeEl.style.opacity  = Math.min(1, (currentX - 60) / 60).toString();
            if (nopeEl)  nopeEl.style.opacity  = '0';
            if (superEl) superEl.style.opacity = '0';
        } else if (currentX < -60) {
            if (nopeEl)  nopeEl.style.opacity  = Math.min(1, (-currentX - 60) / 60).toString();
            if (likeEl)  likeEl.style.opacity  = '0';
            if (superEl) superEl.style.opacity = '0';
        } else if (currentY < -80) {
            if (superEl) superEl.style.opacity = Math.min(1, (-currentY - 80) / 60).toString();
            if (likeEl)  likeEl.style.opacity  = '0';
            if (nopeEl)  nopeEl.style.opacity  = '0';
        } else {
            if (likeEl)  likeEl.style.opacity  = '0';
            if (nopeEl)  nopeEl.style.opacity  = '0';
            if (superEl) superEl.style.opacity = '0';
        }
    }

    async function dragEnd() {
        if (!isDragging) return;
        isDragging = false;

        const card   = getCurrentCard();
        const userId = getCurrentUserId();
        if (!card || !userId) return;

        card.style.transition = 'transform .3s ease';

        if (currentX > 100) {
            // Swiped right = Like
            animateCard(card, 'right');
            await sendLike(userId, 'like');
            setTimeout(() => nextCard(card), 350);
        } else if (currentX < -100) {
            // Swiped left = Pass
            animateCard(card, 'left');
            await sendPass(userId);
            setTimeout(() => nextCard(card), 350);
        } else {
            // Snap back
            card.style.transform = `scale(1) translateY(0px)`;
            const likeEl  = document.getElementById('likeIndicator-' + userId);
            const nopeEl  = document.getElementById('nopeIndicator-' + userId);
            const superEl = document.getElementById('superIndicator-' + userId);
            if (likeEl)  likeEl.style.opacity  = '0';
            if (nopeEl)  nopeEl.style.opacity  = '0';
            if (superEl) superEl.style.opacity = '0';
        }

        currentX = 0;
        // Re-init swipe for next card
        setTimeout(initSwipe, 400);
    }

    // ── Keyboard shortcuts ────────────────────────────────────
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowRight') swipeAction('like');
        if (e.key === 'ArrowLeft')  swipeAction('pass');
        if (e.key === 'ArrowUp')    swipeAction('super_like');
    });

    // ── CSS Animations ────────────────────────────────────────
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fall {
            to { transform: translateY(500px) rotate(360deg); opacity: 0; }
        }
        .swipe-card { user-select: none; }
        .swipe-card:active { cursor: grabbing; }
    `;
    document.head.appendChild(style);

    // ── Init ──────────────────────────────────────────────────
    initSwipe();
</script>
@endpush