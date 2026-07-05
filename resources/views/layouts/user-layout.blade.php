{{-- resources/views/layouts/user-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'The Love Project') — My Account</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --pink:       #ec4899;
            --purple:     #a855f7;
            --dark-purple:#7c3aed;
            --pink-light: #fce7f3;
            --purple-light:#f3e8ff;
            --gradient:   linear-gradient(135deg, #ec4899, #a855f7);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #fce7f3 0%, #ede9fe 50%, #fce7f3 100%);
            min-height: 100vh;
            color: #1f2937;
        }

        /* ── Sidebar ─────────────────────────────── */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(236,72,153,0.1);
            position: fixed;
            left: 0; top: 0;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            transition: transform .3s ease;
        }

        .sidebar-logo {
            padding: 24px 20px;
            border-bottom: 1px solid rgba(236,72,153,0.1);
            text-align: center;
        }

        .sidebar-logo img { height: 48px; }

        .sidebar-logo .tagline {
            font-size: 11px;
            color: #a855f7;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .sidebar-user {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(236,72,153,0.08);
        }

        .sidebar-avatar {
            width: 44px; height: 44px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 16px;
            flex-shrink: 0;
            overflow: hidden;
        }

        .sidebar-avatar img { width: 100%; height: 100%; object-fit: cover; }

        .sidebar-user-info .name {
            font-weight: 600; font-size: 14px; color: #1f2937;
        }

        .sidebar-user-info .role-badge {
            font-size: 11px; color: #a855f7; font-weight: 500;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 8px 12px 4px;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all .2s ease;
            margin-bottom: 3px;
            position: relative;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--pink-light);
            color: var(--pink);
        }

        .sidebar-nav .nav-link.active {
            background: var(--gradient);
            color: white;
            box-shadow: 0 4px 12px rgba(236,72,153,0.3);
        }

        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .nav-badge {
            margin-left: auto;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            min-width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(236,72,153,0.08);
        }

        /* ── Main Content ────────────────────────── */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin .3s ease;
        }

        /* ── Top Navbar ──────────────────────────── */
        .top-navbar {
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(236,72,153,0.1);
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .top-navbar .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-icon-btn {
            width: 40px; height: 40px;
            border-radius: 50%;
            background: var(--pink-light);
            border: none;
            display: flex; align-items: center; justify-content: center;
            color: var(--pink);
            font-size: 15px;
            cursor: pointer;
            position: relative;
            transition: all .2s;
        }

        .top-icon-btn:hover {
            background: var(--gradient);
            color: white;
            transform: scale(1.05);
        }

        .top-icon-btn .badge-dot {
            position: absolute;
            top: -2px; right: -2px;
            background: #ef4444;
            color: white;
            font-size: 9px;
            font-weight: 700;
            padding: 1px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
        }

        /* ── Page Body ───────────────────────────── */
        .page-body {
            padding: 28px;
        }

        /* ── Glass Card ──────────────────────────── */
        .glass-card {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 4px 24px rgba(236,72,153,0.07);
            padding: 24px;
        }

        /* ── Gradient Button ─────────────────────── */
        .btn-gradient {
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 10px 22px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 12px rgba(236,72,153,0.3);
        }

        .btn-gradient:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(236,72,153,0.4);
            color: white;
        }

        /* ── Mobile Toggle ───────────────────────── */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 22px;
            color: var(--pink);
            cursor: pointer;
        }

        /* ── Notification Dropdown ───────────────── */
        .notif-dropdown {
            position: absolute;
            top: 50px; right: 0;
            width: 340px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.15);
            border: 1px solid rgba(236,72,153,0.1);
            display: none;
            z-index: 9999;
        }

        .notif-dropdown.open { display: block; }

        .notif-header {
            padding: 16px 20px;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .notif-item {
            padding: 12px 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            border-bottom: 1px solid #f9fafb;
            text-decoration: none;
            color: inherit;
            transition: background .15s;
        }

        .notif-item:hover { background: #fdf2f8; }

        .notif-item.unread { background: #fdf2f8; }

        .notif-icon {
            width: 36px; height: 36px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        /* ── Responsive ──────────────────────────── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.open { transform: translateX(0); }

            .main-content { margin-left: 0; }

            .mobile-toggle { display: block; }

            .page-body { padding: 16px; }

            .top-navbar { padding: 12px 16px; }
        }

        /* ── Animations ──────────────────────────── */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-in-up { animation: fadeInUp .4s ease forwards; }

        /* ── Toast ───────────────────────────────── */
        .toast-container {
            position: fixed;
            bottom: 24px; right: 24px;
            z-index: 9999;
        }

        .custom-toast {
            background: white;
            border-radius: 14px;
            padding: 14px 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            border-left: 4px solid var(--pink);
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            min-width: 280px;
            animation: fadeInUp .3s ease;
        }

        .custom-toast.success { border-color: #22c55e; }
        .custom-toast.error   { border-color: #ef4444; }
        .custom-toast.info    { border-color: #3b82f6; }

        /* ── Overlay (mobile sidebar) ────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }

        .sidebar-overlay.open { display: block; }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar Overlay (mobile) -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">

    <!-- Logo -->
    <div class="sidebar-logo">
        <a href="{{ route('member.dashboard') }}">
            <img src="{{ asset('assets/images/love_logo.png') }}" alt="The Love Project">
        </a>
        <div class="tagline">52 Weeks to Forever</div>
    </div>

    <!-- User Info -->
    @auth
    <div class="sidebar-user">
        <div class="sidebar-avatar">
            @if(auth()->user()->profile?->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile->profile_picture) }}" alt="">
            @else
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            @endif
        </div>
        <div class="sidebar-user-info">
            <div class="name">{{ auth()->user()->name }}</div>
            <div class="role-badge">
                <i class="fas fa-heart me-1" style="font-size:9px;"></i>
                {{ auth()->user()->profile?->personality_type ?? 'Love Seeker' }}
            </div>
        </div>
    </div>
    @endauth

    <!-- Navigation -->
  <nav class="sidebar-nav">
    <div class="nav-section-label">Main Menu</div>

    <a href="{{ route('member.dashboard') }}"
       class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}">
        <i class="fas fa-home"></i>
        Dashboard
    </a>

    {{-- Discover --}}
    <a href="{{ route('member.discover') }}"
       class="nav-link {{ request()->routeIs('member.discover') ? 'active' : '' }}">
        <i class="fas fa-fire"></i>
        Discover
        @php
            $newLikesCount = 0;
            if(auth()->check()) {
                $newLikesCount = \App\Models\UserLike::where('receiver_id', auth()->id())
                    ->where('type', '!=', 'pass')
                    ->where('is_mutual', false)
                    ->count();
            }
        @endphp
        @if($newLikesCount > 0)
            <span class="nav-badge">{{ $newLikesCount }}</span>
        @endif
    </a>

    {{-- Matches --}}
    <a href="{{ route('member.matches') }}"
       class="nav-link {{ request()->routeIs('member.matches*') ? 'active' : '' }}">
        <i class="fas fa-heart"></i>
        My Matches
        @php
            $pendingMatchCount = 0;
            if(auth()->check()) {
                $pendingMatchCount = \App\Models\UserMatch::where(function($q) {
                    $q->where('user_one_id', auth()->id())
                      ->orWhere('user_two_id', auth()->id());
                })->where('status', 'suggested')->count();
            }
        @endphp
        @if($pendingMatchCount > 0)
            <span class="nav-badge">{{ $pendingMatchCount }}</span>
        @endif
    </a>

    {{-- Messages --}}
    <a href="{{ route('member.chat') }}"
       class="nav-link {{ request()->routeIs('member.chat*') ? 'active' : '' }}">
        <i class="fas fa-comments"></i>
        Messages
        @php
            $unreadMsgCount = 0;
            if(auth()->check()) {
                $unreadMsgCount = \App\Models\Message::where('receiver_id', auth()->id())
                    ->where('is_read', false)->count();
            }
        @endphp
        @if($unreadMsgCount > 0)
            <span class="nav-badge">{{ $unreadMsgCount }}</span>
        @endif
    </a>

    {{-- Quiz --}}
    <a href="{{ route('member.quiz') }}"
       class="nav-link {{ request()->routeIs('member.quiz*') ? 'active' : '' }}">
        <i class="fas fa-brain"></i>
        Love Quiz
    </a>

    {{-- 52 Weeks --}}
    <a href="{{ route('member.content') }}"
       class="nav-link {{ request()->routeIs('member.content*') ? 'active' : '' }}">
        <i class="fas fa-book-heart"></i>
        52 Weeks
    </a>

    <div class="nav-section-label mt-2">Community</div>

    <a href="{{ route('member.forum') }}"
       class="nav-link {{ request()->routeIs('member.forum*') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        Community Forum
    </a>

    <a href="{{ route('member.blog') }}"
       class="nav-link {{ request()->routeIs('member.blog*') ? 'active' : '' }}">
        <i class="fas fa-newspaper"></i>
        Expert Advice
    </a>

    <div class="nav-section-label mt-2">Account</div>

    <a href="{{ route('profile.edit') }}"
       class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
        <i class="fas fa-user-edit"></i>
        Edit Profile
    </a>

    <a href="{{ route('member.plans') }}"
       class="nav-link {{ request()->routeIs('member.plans*') ? 'active' : '' }}">
        <i class="fas fa-crown"></i>
        Premium Plans
    </a>

    @if(auth()->user()?->isAdmin())
    <div class="nav-section-label mt-2">Administration</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link">
        <i class="fas fa-shield-halved"></i>
        Admin Panel
    </a>
    @endif

</nav>

    <!-- Logout -->
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-100 border-0 bg-transparent" style="color:#ef4444;">
                <i class="fas fa-right-from-bracket"></i>
                Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- Main Content -->
<div class="main-content">

    <!-- Top Navbar -->
    <div class="top-navbar">
        <div class="d-flex align-items-center gap-3">
            <button class="mobile-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <span class="page-title">@yield('page-title', 'Dashboard')</span>
        </div>

        <div class="top-actions">
            <!-- Notifications -->
            <div style="position:relative;">
                <button class="top-icon-btn" id="notifBtn" onclick="toggleNotifications()">
                    <i class="fas fa-bell"></i>
                    <span class="badge-dot" id="notifBadge" style="display:none;">0</span>
                </button>

                <div class="notif-dropdown" id="notifDropdown">
                    <div class="notif-header">
                        <span style="font-weight:700;font-size:15px;">Notifications</span>
                        <button onclick="markAllRead()" class="btn btn-sm" style="color:#ec4899;font-size:12px;border:none;background:none;">
                            Mark all read
                        </button>
                    </div>
                    <div id="notifList">
                        <div style="padding:20px;text-align:center;color:#9ca3af;">
                            <i class="fas fa-bell-slash fa-2x mb-2"></i>
                            <p style="font-size:13px;">No new notifications</p>
                        </div>
                    </div>
                    <div style="padding:12px;text-align:center;border-top:1px solid #f3f4f6;">
                        <a href="{{ route('member.notifications') }}" style="color:#ec4899;font-size:13px;font-weight:600;text-decoration:none;">
                            View all notifications
                        </a>
                    </div>
                </div>
            </div>

            <!-- Messages shortcut -->
            <a href="{{ route('member.chat') }}" class="top-icon-btn" style="text-decoration:none;">
                <i class="fas fa-comment-dots"></i>
                @if(isset($unreadMessages) && $unreadMessages > 0)
                    <span class="badge-dot">{{ $unreadMessages }}</span>
                @endif
            </a>

            <!-- Profile -->
            <a href="{{ route('profile.edit') }}" class="top-icon-btn" style="text-decoration:none;">
                <i class="fas fa-user"></i>
            </a>

            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="top-icon-btn" style="border:none;text-decoration:none;cursor:pointer;" title="Sign Out">
                    <i class="fas fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
    <div style="margin:16px 28px 0;">
        <div class="custom-toast success" style="position:relative;margin:0;animation:none;">
            <i class="fas fa-check-circle" style="color:#22c55e;font-size:18px;"></i>
            <span>{{ session('success') }}</span>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div style="margin:16px 28px 0;">
        <div class="custom-toast error" style="position:relative;margin:0;animation:none;">
            <i class="fas fa-circle-xmark" style="color:#ef4444;font-size:18px;"></i>
            <span>{{ session('error') }}</span>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div style="margin:16px 28px 0;">
        <div class="custom-toast info" style="position:relative;margin:0;animation:none;">
            <i class="fas fa-circle-info" style="color:#3b82f6;font-size:18px;"></i>
            <span>{{ session('info') }}</span>
        </div>
    </div>
    @endif

    <!-- Page Content -->
    <div class="page-body">
        @yield('content')
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ── Sidebar Toggle ──────────────────────────────────────
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }

    function closeSidebar() {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('open');
    }

    // ── Notifications ───────────────────────────────────────
    function toggleNotifications() {
        document.getElementById('notifDropdown').classList.toggle('open');
    }

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('notifDropdown');
        const btn      = document.getElementById('notifBtn');
        if (!btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });

    async function loadNotifications() {
        // Unused — notification polling is handled by pollNotifications()
        // which fetches from /member/notifications/unread
    }

    async function pollNotifications() {
        try {
            const res  = await fetch('/member/notifications/unread');
            const data = await res.json();

            const badge = document.getElementById('notifBadge');
            badge.style.display = data.count > 0 ? 'block' : 'none';
            badge.textContent    = data.count > 99 ? '99+' : data.count;

            if (data.notifications.length > 0) {
                const list = document.getElementById('notifList');
                list.innerHTML = data.notifications.map(n => `
                    <a href="${n.url || '#'}" class="notif-item unread" style="text-decoration:none;">
                        <div class="notif-icon" style="background:${n.color}22;color:${n.color};">
                            <i class="fas ${n.icon}"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:600;font-size:13px;color:#1f2937;">${n.title}</div>
                            <div style="font-size:12px;color:#6b7280;margin-top:2px;">${n.message}</div>
                            <div style="font-size:11px;color:#9ca3af;margin-top:4px;">${n.time}</div>
                        </div>
                    </a>
                `).join('');
            }
        } catch(e) {}
    }

    async function markAllRead() {
        await fetch('{{ route("member.notifications.readAll") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
        });
        pollNotifications();
    }

    // Poll every 15 seconds
    pollNotifications();
    setInterval(pollNotifications, 15000);

    // ── Toast Helper ─────────────────────────────────────────
    function showToast(message, type = 'success') {
        const icons = { success: 'fa-check-circle', error: 'fa-circle-xmark', info: 'fa-circle-info' };
        const colors= { success: '#22c55e', error: '#ef4444', info: '#3b82f6' };
        const el    = document.createElement('div');
        el.className = `custom-toast ${type}`;
        el.innerHTML = `<i class="fas ${icons[type]}" style="color:${colors[type]};font-size:18px;"></i><span>${message}</span>`;
        document.getElementById('toastContainer').appendChild(el);
        setTimeout(() => el.remove(), 4000);
    }
</script>

@stack('scripts')
</body>
</html>