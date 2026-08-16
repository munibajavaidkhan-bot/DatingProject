{{-- resources/views/layouts/admin-layout.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Love Project</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f14; color: #e5e7eb; min-height: 100vh; margin: 0; }

        .admin-sidebar {
            width: 250px; min-height: 100vh;
            background: #1a1a24;
            border-right: 1px solid rgba(236,72,153,0.1);
            position: fixed; left: 0; top: 0;
            display: flex; flex-direction: column;
            z-index: 1000;
        }

        .admin-logo {
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            text-align: center;
        }

        .admin-logo img { height: 40px; }

        .admin-badge {
            display: inline-block;
            background: linear-gradient(135deg,#ec4899,#a855f7);
            color: white; font-size: 10px; font-weight: 700;
            padding: 2px 10px; border-radius: 20px;
            text-transform: uppercase; letter-spacing: 1px;
            margin-top: 6px;
        }

        .admin-nav { flex:1; padding: 16px 12px; overflow-y:auto; }

        .admin-nav-label {
            font-size: 10px; font-weight: 700; color: #4b5563;
            text-transform: uppercase; letter-spacing: 1.5px;
            padding: 8px 12px 4px;
        }

        .admin-nav a {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; border-radius: 10px;
            color: #9ca3af; font-size: 13px; font-weight: 500;
            text-decoration: none; transition: all .2s;
            margin-bottom: 3px;
        }

        .admin-nav a:hover { background: rgba(255,255,255,0.06); color: white; }

        .admin-nav a.active {
            background: linear-gradient(135deg,#ec4899,#a855f7);
            color: white;
        }

        .admin-nav a i { width: 18px; text-align: center; }

        .admin-main { margin-left: 250px; min-height: 100vh; }

        .admin-topbar {
            background: #1a1a24;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            padding: 14px 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 900;
        }

        .admin-topbar .page-title {
            font-size: 18px; font-weight: 700; color: white;
        }

        .admin-body { padding: 24px 28px; }

        .admin-card {
            background: #1a1a24;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.06);
            padding: 20px;
            margin-bottom: 0;
        }

        .admin-table th { color: #6b7280; font-size: 11px; text-transform: uppercase; font-weight: 700; padding: 10px 14px; border-bottom: 1px solid rgba(255,255,255,0.06); }
        .admin-table td { padding: 12px 14px; color: #d1d5db; font-size: 13px; border-bottom: 1px solid rgba(255,255,255,0.04); }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }

        .admin-btn {
            background: linear-gradient(135deg,#ec4899,#a855f7);
            color: white; border: none; border-radius: 10px;
            padding: 8px 16px; font-size: 13px; font-weight: 600;
            cursor: pointer; text-decoration: none; display: inline-block;
            transition: all .2s;
        }
        .admin-btn:hover { opacity: .9; color: white; transform: translateY(-1px); }
    </style>

    @stack('styles')
</head>
<body>

<aside class="admin-sidebar">
    <div class="admin-logo">
        <img src="{{ asset('assets/images/love_logo.png') }}" alt="Love Project">
        <div class="admin-badge"><i class="fas fa-shield-halved me-1"></i>Admin Panel</div>
    </div>

    <nav class="admin-nav">
        <div class="admin-nav-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-gauge-high"></i> Dashboard
        </a>

        <div class="admin-nav-label">Users</div>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> All Users
        </a>
        <a href="{{ route('admin.approvals') }}" class="{{ request()->routeIs('admin.approvals*') ? 'active' : '' }}">
            <i class="fas fa-user-check"></i> Profile Approvals
            @php $pendingCount = \App\Models\Profile::where('is_complete', true)->where('is_approved', false)->count(); @endphp
            @if($pendingCount > 0)
                <span style="background:#ef4444;color:white;font-size:10px;padding:2px 7px;border-radius:10px;margin-left:auto;">{{ $pendingCount }}</span>
            @endif
        </a>

        <div class="admin-nav-label">Content</div>
        <a href="{{ route('admin.blog.index') }}" class="{{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Blog Posts
        </a>
        <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles*') ? 'active' : '' }}">
            <i class="fas fa-file-lines"></i> Articles
        </a>
        <a href="{{ route('admin.stories.index') }}" class="{{ request()->routeIs('admin.stories*') ? 'active' : '' }}">
            <i class="fas fa-book-open"></i> Stories
        </a>
        <a href="{{ route('admin.content.index') }}" class="{{ request()->routeIs('admin.content*') ? 'active' : '' }}">
            <i class="fas fa-book"></i> 52 Weeks
        </a>
        <a href="{{ route('admin.poems.index') }}" class="{{ request()->routeIs('admin.poems*') ? 'active' : '' }}">
            <i class="fas fa-heart"></i> Poems
        </a>
        <a href="{{ route('admin.forum') }}" class="{{ request()->routeIs('admin.forum*') ? 'active' : '' }}">
            <i class="fas fa-comments"></i> Forum
        </a>
        <a href="{{ route('admin.chat.index') }}" class="{{ request()->routeIs('admin.chat*') ? 'active' : '' }}">
            <i class="fas fa-message"></i> Chat Monitor
        </a>

        <div class="admin-nav-label">System</div>
        <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
            <i class="fas fa-sliders"></i> Feature Toggles
        </a>
        <a href="{{ route('member.dashboard') }}">
            <i class="fas fa-arrow-left"></i> Back to Site
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" style="width:100%;background:none;border:none;color:#ef4444;font-size:13px;font-weight:500;padding:10px 14px;border-radius:10px;text-align:left;cursor:pointer;display:flex;align-items:center;gap:12px;">
                <i class="fas fa-right-from-bracket" style="width:18px;text-align:center;"></i> Sign Out
            </button>
        </form>
    </nav>
</aside>

<div class="admin-main">
    <div class="admin-topbar">
        <span class="page-title">@yield('page-title', 'Dashboard')</span>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:13px;color:#6b7280;">
                <i class="fas fa-user me-2"></i>{{ auth()->user()->name }}
            </span>
        </div>
    </div>

    @if(session('success'))
    <div style="margin:16px 28px 0;">
        <div style="background:#d1fae5;border:1px solid #6ee7b7;border-radius:12px;padding:12px 16px;color:#065f46;font-size:14px;display:flex;align-items:center;gap:10px;">
            <i class="fas fa-check-circle"></i>{{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div style="margin:16px 28px 0;">
        <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:12px;padding:12px 16px;color:#991b1b;font-size:14px;display:flex;align-items:center;gap:10px;">
            <i class="fas fa-circle-xmark"></i>{{ session('error') }}
        </div>
    </div>
    @endif

    <div class="admin-body">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>