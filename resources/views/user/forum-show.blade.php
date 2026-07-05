@extends('layouts.user-layout')

@section('title', 'Community Forum')
@section('page-title', 'Community Forum')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:24px;padding:32px;color:white;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:28px;font-weight:700;margin-bottom:6px;">Community Forum</h2>
        <p style="opacity:0.9;font-size:14px;margin:0;">{{ $totalThreads }} threads · {{ $totalPosts }} replies</p>
    </div>
    <a href="{{ route('member.forum.create') }}" style="background:white;color:#ec4899;text-decoration:none;padding:12px 24px;border-radius:14px;font-weight:700;font-size:14px;">
        <i class="fas fa-plus me-2"></i>New Thread
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-3">
        <div class="glass-card mb-4">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:14px;">Categories</h6>
            <a href="{{ route('member.forum') }}" style="display:block;padding:8px 12px;border-radius:10px;text-decoration:none;font-size:13px;font-weight:600;color:{{ !request('category') ? '#ec4899' : '#6b7280' }};background:{{ !request('category') ? '#fce7f3' : 'transparent' }};margin-bottom:4px;">
                All Topics
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('member.forum', ['category' => $cat->slug]) }}"
               style="display:flex;align-items:center;gap:8px;padding:8px 12px;border-radius:10px;text-decoration:none;font-size:13px;color:{{ request('category') === $cat->slug ? $cat->color : '#6b7280' }};background:{{ request('category') === $cat->slug ? $cat->color.'18' : 'transparent' }};margin-bottom:4px;">
                <i class="fas {{ $cat->icon }}" style="width:16px;"></i>
                <span style="flex:1;">{{ $cat->name }}</span>
                <span style="font-size:11px;opacity:0.7;">{{ $cat->threads_count }}</span>
            </a>
            @endforeach
        </div>
    </div>

    <div class="col-lg-9">
        {{-- Search & Sort --}}
        <div class="glass-card mb-4" style="padding:16px 20px;">
            <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search discussions..."
                       style="flex:1;min-width:200px;padding:10px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
                <select name="sort" style="padding:10px 14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;">
                    <option value="latest"  {{ request('sort','latest') === 'latest'  ? 'selected' : '' }}>Latest</option>
                    <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Most Liked</option>
                    <option value="replies" {{ request('sort') === 'replies' ? 'selected' : '' }}>Most Replies</option>
                    <option value="views"   {{ request('sort') === 'views'   ? 'selected' : '' }}>Most Views</option>
                </select>
                <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:10px 20px;font-weight:600;cursor:pointer;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>

        {{-- Threads --}}
        @forelse($threads as $thread)
        <div class="glass-card mb-3" style="padding:20px;">
            <div style="display:flex;gap:16px;align-items:flex-start;">
                <img src="{{ $thread->user->getAvatarUrl() }}"
                     style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid rgba(236,72,153,0.2);flex-shrink:0;">
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;flex-wrap:wrap;">
                        @if($thread->category)
                        <span style="background:{{ $thread->category->color }}22;color:{{ $thread->category->color }};font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;">
                            {{ $thread->category->name }}
                        </span>
                        @endif
                        @if($thread->is_pinned)
                        <span style="background:#fef3c7;color:#92400e;font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;">
                            <i class="fas fa-thumbtack"></i> Pinned
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('member.forum.show', $thread->slug) }}" style="text-decoration:none;">
                        <h5 style="font-weight:700;color:#1f2937;font-size:16px;margin-bottom:6px;line-height:1.4;">{{ $thread->title }}</h5>
                    </a>
                    <p style="font-size:13px;color:#6b7280;margin-bottom:10px;line-height:1.5;">{{ Str::limit(strip_tags($thread->body), 140) }}</p>
                    <div style="display:flex;align-items:center;gap:16px;font-size:12px;color:#9ca3af;flex-wrap:wrap;">
                        <span><i class="fas fa-user me-1"></i>{{ $thread->user->name }}</span>
                        <span><i class="fas fa-clock me-1"></i>{{ $thread->created_at->diffForHumans() }}</span>
                        <span><i class="fas fa-comments me-1"></i>{{ $thread->replies_count }} replies</span>
                        <span><i class="fas fa-heart me-1"></i>{{ $thread->likes_count }}</span>
                        <span><i class="fas fa-eye me-1"></i>{{ $thread->views }} views</span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="glass-card text-center" style="padding:60px 20px;">
            <i class="fas fa-comments fa-3x mb-3" style="color:#d1d5db;"></i>
            <h5 style="color:#6b7280;font-weight:600;">No discussions yet</h5>
            <p style="color:#9ca3af;font-size:14px;">Be the first to start a conversation!</p>
            <a href="{{ route('member.forum.create') }}" style="display:inline-block;margin-top:16px;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;padding:12px 24px;border-radius:14px;font-weight:600;">
                Start a Thread
            </a>
        </div>
        @endforelse

        <div class="mt-3">{{ $threads->withQueryString()->links() }}</div>
    </div>
</div>

@endsection
