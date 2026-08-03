<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Author') — The Love Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background: #f8f4ff; margin: 0; }
        .sidebar { width: 230px; min-height: 100vh; background: linear-gradient(175deg,#1e0a3c,#4338ca); position: fixed; left: 0; top: 0; padding: 20px 0; }
        .sidebar a { display: flex; align-items: center; gap: 10px; padding: 11px 20px; color: rgba(255,255,255,.65); text-decoration: none; font-size: 13px; }
        .sidebar a:hover, .sidebar a.active { background: rgba(255,255,255,.08); color: white; }
        .main { margin-left: 230px; padding: 28px; }
        .card-box { background: white; border-radius: 16px; padding: 24px; border: 1px solid #ede9fe; }
    </style>
</head>
<body>
<aside class="sidebar">
    <div style="padding:0 20px 20px;color:white;font-family:'Playfair Display',serif;font-weight:700;">Love Project</div>
    <a href="{{ route('author.dashboard') }}" class="{{ request()->routeIs('author.dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Dashboard</a>
    <a href="{{ route('author.blog.index') }}" class="{{ request()->routeIs('author.blog*') ? 'active' : '' }}"><i class="fas fa-newspaper"></i> My Articles</a>
    <a href="{{ route('author.blog.create') }}"><i class="fas fa-plus"></i> New Article</a>
    <a href="{{ route('profile.edit') }}"><i class="fas fa-user"></i> Profile</a>
    <form method="POST" action="{{ route('logout') }}" style="margin-top:20px;padding:0 20px;">
        @csrf
        <button type="submit" style="background:rgba(255,255,255,.1);border:none;color:white;width:100%;padding:10px;border-radius:10px;cursor:pointer;">Logout</button>
    </form>
</aside>
<main class="main">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
