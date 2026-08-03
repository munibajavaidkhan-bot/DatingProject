<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Author Dashboard — The Love Project</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f4ff; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: 240px; min-height: 100vh;
            background: linear-gradient(175deg, #1e0a3c 0%, #3730a3 60%, #4338ca 100%);
            position: fixed; top: 0; left: 0; z-index: 100;
            display: flex; flex-direction: column;
            box-shadow: 4px 0 24px rgba(0,0,0,0.2);
        }
        .sidebar-brand { padding: 26px 20px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-brand-text { font-family: 'Playfair Display', serif; font-size: 17px; color: white; font-weight: 700; }
        .sidebar-badge { background: linear-gradient(135deg,#ec4899,#a855f7); color: white; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 10px; letter-spacing: 0.5px; }
        .s-label { padding: 18px 20px 6px; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.3); font-weight: 700; }
        .s-link {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 20px; text-decoration: none;
            color: rgba(255,255,255,0.6); font-size: 13.5px; font-weight: 500;
            border-left: 3px solid transparent; transition: all 0.2s;
        }
        .s-link:hover { background: rgba(255,255,255,0.06); color: white; }
        .s-link.active { background: rgba(168,85,247,0.2); color: #d8b4fe; border-left-color: #a855f7; }
        .s-link i { width: 18px; text-align: center; font-size: 14px; }
        .s-pill { margin-left: auto; background: #a855f7; color: white; font-size: 10px; font-weight: 800; padding: 2px 7px; border-radius: 10px; }
        .sidebar-footer { margin-top: auto; padding: 18px 20px; border-top: 1px solid rgba(255,255,255,0.07); }
        .author-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg,#a855f7,#6366f1); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 15px; }

        /* Main */
        .main { margin-left: 240px; min-height: 100vh; }

        /* Topbar */
        .topbar { background: white; height: 64px; display: flex; align-items: center; justify-content: space-between; padding: 0 28px; box-shadow: 0 1px 0 #ede9fe; position: sticky; top: 0; z-index: 50; }
        .icon-btn { width: 38px; height: 38px; border-radius: 10px; border: none; background: #f5f3ff; color: #6b7280; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 15px; transition: 0.2s; text-decoration: none; }
        .icon-btn:hover { background: #ede9fe; color: #7c3aed; }

        /* Page Body */
        .page-body { padding: 28px; }

        /* Cards */
        .stat-card { background: white; border-radius: 18px; padding: 22px; border: 1px solid #ede9fe; box-shadow: 0 2px 8px rgba(99,102,241,0.05); transition: transform 0.25s; }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 14px; }
        .stat-val { font-size: 1.9rem; font-weight: 800; color: #0f172a; line-height: 1; }
        .stat-lbl { font-size: 12px; color: #94a3b8; margin-top: 3px; }

        .content-card { background: white; border-radius: 18px; padding: 24px; border: 1px solid #ede9fe; box-shadow: 0 2px 8px rgba(99,102,241,0.04); }
        .card-title-sm { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: #a78bfa; font-weight: 700; margin-bottom: 4px; }
        .card-title { font-size: 1.1rem; font-weight: 700; color: #1e293b; margin-bottom: 18px; }

        /* Lesson table */
        .lesson-row { display: flex; align-items: center; gap: 14px; padding: 14px 0; border-bottom: 1px solid #f5f3ff; }
        .lesson-row:last-child { border-bottom: none; }
        .week-badge { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 13px; color: white; flex-shrink: 0; }
        .status-chip { padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .status-chip.live      { background: #dcfce7; color: #166534; }
        .status-chip.draft     { background: #fef3c7; color: #92400e; }
        .status-chip.scheduled { background: #dbeafe; color: #1e40af; }

        .action-sm { padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; transition: 0.2s; }
        .action-sm.edit { background: #f5f3ff; color: #7c3aed; }
        .action-sm.edit:hover { background: #ede9fe; }
        .action-sm.pub { background: #dcfce7; color: #166534; }
        .action-sm.del { background: #fee2e2; color: #991b1b; }

        /* Comment queue */
        .comment-item { display: flex; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f5f3ff; }
        .comment-item:last-child { border-bottom: none; }
        .c-avatar { width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 12px; flex-shrink: 0; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand d-flex align-items-center gap-2">
        <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#ec4899,#a855f7);display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-heart" style="color:white;font-size:16px;"></i>
        </div>
        <div>
            <div class="sidebar-brand-text">Love Project</div>
            <span class="sidebar-badge">AUTHOR</span>
        </div>
    </div>

    <div class="s-label">Content</div>
    <a href="{{ route('author.dashboard') }}" class="s-link active"><i class="fas fa-th-large"></i> Dashboard</a>
    <a href="{{ route('author.blog.index') }}" class="s-link"><i class="fas fa-book-open"></i> My Articles <span class="s-pill">{{ $stats['published'] ?? 0 }}</span></a>
    <a href="{{ route('author.blog.create') }}" class="s-link"><i class="fas fa-plus-circle"></i> New Article</a>
    <a href="#" class="s-link"><i class="fas fa-poll"></i> Quiz Builder</a>
    <a href="#" class="s-link"><i class="fas fa-images"></i> Media Library</a>

    <div class="s-label">Community</div>
    <a href="#" class="s-link"><i class="fas fa-comments"></i> Forum Posts <span class="s-pill">4</span></a>
    <a href="#" class="s-link"><i class="fas fa-flag"></i> Flagged Content</a>

    <div class="s-label">Reports</div>
    <a href="#" class="s-link"><i class="fas fa-chart-line"></i> Content Analytics</a>
    <a href="#" class="s-link"><i class="fas fa-star"></i> Top Performing</a>

    <div class="s-label">Account</div>
    <a href="{{ route('profile.edit') }}" class="s-link"><i class="fas fa-user-edit"></i> My Profile</a>
    <a href="{{ route('terms') }}" class="s-link"><i class="fas fa-file-contract"></i> Legal</a>

    <div class="sidebar-footer">
        <div class="d-flex align-items-center gap-2">
            <div class="author-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
            <div>
                <div style="color:white;font-weight:600;font-size:13px;">{{ auth()->user()->name ?? 'Author' }}</div>
                <div style="color:rgba(255,255,255,0.4);font-size:11px;">Content Author</div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ms-auto">
                @csrf
                <button type="submit" class="icon-btn" style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.4);" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- MAIN -->
<div class="main">
    <!-- Topbar -->
    <div class="topbar">
        <div>
            <h5 class="mb-0 fw-bold" style="color:#1e293b; font-family:'Playfair Display',serif;">Author Dashboard</h5>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="#" class="icon-btn" title="Notifications"><i class="fas fa-bell"></i></a>
            <a href="{{ route('profile.edit') }}" class="icon-btn" title="Profile"><i class="fas fa-user"></i></a>
            <div class="d-flex align-items-center gap-2 ps-3" style="border-left:1px solid #ede9fe;">
                <div class="author-avatar" style="width:34px;height:34px;font-size:13px;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <div style="font-size:13px;font-weight:700;color:#1e293b;">{{ auth()->user()->name ?? 'Author' }}</div>
                    <div style="font-size:11px;color:#94a3b8;">Content Author</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Body -->
    <div class="page-body">

        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 style="font-family:'Playfair Display',serif;font-size:1.7rem;font-weight:800;color:#0f172a;margin:0;">
                    Welcome back, {{ auth()->user()->name ?? 'Author' }}! ✍️
                </h1>
                <p style="color:#94a3b8;font-size:14px;margin:4px 0 0;">Manage your lessons, quiz content, and community contributions.</p>
            </div>
            <a href="{{ route('author.blog.create') }}" class="btn px-4 py-2 rounded-pill fw-bold text-white"
               style="background:linear-gradient(135deg,#a855f7,#6366f1);border:none;font-size:14px;">
                <i class="fas fa-plus me-2"></i>New Article
            </a>
        </div>

        <!-- Stat Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#f5f3ff;">📚</div>
                    <div class="stat-val">{{ $stats['published'] }}</div>
                    <div class="stat-lbl">Published Articles</div>
                    <div class="mt-2" style="font-size:12px;color:#22c55e;font-weight:700;">↑ 2 this month</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#fce7f3;">👁️</div>
                    <div class="stat-val">{{ number_format($stats['total_views']) }}</div>
                    <div class="stat-lbl">Total Article Views</div>
                    <div class="mt-2" style="font-size:12px;color:#22c55e;font-weight:700;">↑ +18% this week</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#dcfce7;">✅</div>
                    <div class="stat-val">{{ $stats['drafts'] }}</div>
                    <div class="stat-lbl">Draft Articles</div>
                    <div class="mt-2" style="font-size:12px;color:#22c55e;font-weight:700;">↑ Above average</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon" style="background:#fef9c3;">💬</div>
                    <div class="stat-val">4</div>
                    <div class="stat-lbl">Awaiting Review</div>
                    <div class="mt-2" style="font-size:12px;color:#f59e0b;font-weight:700;">Needs attention</div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Lessons Table -->
            <div class="col-lg-7">
                <div class="content-card">
                    <div class="d-flex align-items-center justify-content-between mb-1">
                        <div>
                            <div class="card-title-sm">Content Management</div>
                            <div class="card-title mb-0">My Articles</div>
                        </div>
                        <a href="{{ route('author.blog.create') }}" class="action-sm edit">+ New</a>
                    </div>
                    <p style="font-size:13px;color:#94a3b8;margin-bottom:20px;">Your recent blog articles.</p>

                    @forelse($recentPosts as $post)
                    <div class="lesson-row">
                        <div class="week-badge" style="background:#a855f7;">{{ strtoupper(substr($post->status, 0, 1)) }}</div>
                        <div class="flex-1">
                            <div style="font-weight:700;font-size:14px;color:#1e293b;">{{ Str::limit($post->title, 50) }}</div>
                            <div style="font-size:12px;color:#94a3b8;">
                                {{ ucfirst($post->status) }} — {{ $post->views }} views — {{ $post->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('author.blog.edit', $post->id) }}" class="action-sm edit">Edit</a>
                        </div>
                    </div>
                    @empty
                    <p style="color:#94a3b8;font-size:14px;">No articles yet. <a href="{{ route('author.blog.create') }}">Write your first post</a></p>
                    @endforelse
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-5 d-flex flex-column gap-4">

                <!-- Quick Actions -->
                <div class="content-card">
                    <div class="card-title-sm">Quick Actions</div>
                    <div class="card-title">Shortcuts</div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('author.blog.create') }}" class="btn py-2 fw-semibold rounded-3 text-white" style="background:linear-gradient(135deg,#a855f7,#6366f1);border:none;font-size:14px;">
                            <i class="fas fa-plus me-2"></i>Create New Article
                        </a>
                        <a href="{{ route('author.blog.index') }}" class="btn py-2 fw-semibold rounded-3" style="background:#f5f3ff;color:#7c3aed;border:none;font-size:14px;">
                            <i class="fas fa-newspaper me-2"></i>All Articles
                        </a>
                        <a href="{{ route('member.forum') }}" class="btn py-2 fw-semibold rounded-3" style="background:#fce7f3;color:#be185d;border:none;font-size:14px;">
                            <i class="fas fa-comments me-2"></i>Community Forum
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn py-2 fw-semibold rounded-3" style="background:#f1f5f9;color:#475569;border:none;font-size:14px;">
                            <i class="fas fa-user-edit me-2"></i>Edit Profile
                        </a>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-title-sm">Tips</div>
                    <div class="card-title">Writing for The Love Journal</div>
                    <p style="font-size:13px;color:#64748b;line-height:1.6;margin:0;">
                        Publish relationship advice articles from your author dashboard. Published posts appear on the member blog at
                        <strong>Expert Advice</strong>.
                    </p>
                    <a href="{{ route('member.blog') }}" class="action-sm edit mt-3 d-inline-block">View public blog</a>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
