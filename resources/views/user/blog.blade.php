@extends('layouts.user-layout')

@section('title', 'Expert Advice — The Love Project')
@section('page-title', 'Expert Advice')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:24px;padding:32px;color:white;margin-bottom:28px;text-align:center;">
    <h2 style="font-family:'Playfair Display',serif;font-size:28px;font-weight:700;margin-bottom:8px;">The Love Journal</h2>
    <p style="opacity:0.9;font-size:14px;margin:0;max-width:560px;margin-left:auto;margin-right:auto;">
        Insights, advice, and stories from relationship experts to guide you on your journey to meaningful connection.
    </p>
</div>

{{-- Search --}}
<div class="glass-card mb-4" style="padding:16px 20px;">
    <form method="GET" style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search articles..."
               style="flex:1;min-width:200px;padding:10px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;outline:none;">
        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:10px 20px;font-weight:600;cursor:pointer;">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>

{{-- Category Filter --}}
@if($categories->count())
<div class="d-flex flex-wrap gap-2 mb-4">
    <a href="{{ route('member.blog') }}"
       style="padding:8px 18px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;
              {{ !request('category') ? 'background:linear-gradient(135deg,#ec4899,#a855f7);color:white;' : 'background:rgba(255,255,255,0.8);color:#6b7280;' }}">
        All
    </a>
    @foreach($categories as $cat)
    <a href="{{ route('member.blog', ['category' => $cat->slug]) }}"
       style="padding:8px 18px;border-radius:20px;font-size:13px;font-weight:600;text-decoration:none;
              {{ request('category') === $cat->slug ? 'background:linear-gradient(135deg,#ec4899,#a855f7);color:white;' : 'background:rgba(255,255,255,0.8);color:#6b7280;' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>
@endif

{{-- Featured --}}
@if($featured->count() && !request('category') && !request('search'))
<div class="mb-4">
    <h5 style="font-family:'Playfair Display',serif;font-weight:700;color:#1f2937;margin-bottom:16px;">Featured</h5>
    <div class="row g-3">
        @foreach($featured as $fp)
        <div class="col-md-4">
            <a href="{{ route('member.blog.show', $fp->slug) }}" class="glass-card d-block text-decoration-none h-100" style="padding:20px;">
                <span style="font-size:11px;font-weight:700;color:#ec4899;text-transform:uppercase;">{{ $fp->category?->name ?? 'Advice' }}</span>
                <h6 style="font-weight:700;color:#1f2937;margin:8px 0 6px;line-height:1.4;">{{ $fp->title }}</h6>
                <p style="font-size:13px;color:#6b7280;margin:0;">{{ Str::limit($fp->excerpt, 80) }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@endif

{{-- Blog Grid --}}
<div class="row g-4">
    @forelse($posts as $post)
    <div class="col-md-6 col-xl-4">
        <div class="glass-card h-100" style="padding:0;overflow:hidden;">
            <div style="height:180px;overflow:hidden;background:linear-gradient(135deg,#fce7f3,#f3e8ff);position:relative;">
                <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?q=80&w=800&auto=format&fit=crop"
                     style="width:100%;height:100%;object-fit:cover;" alt="{{ $post->title }}">
                @if($post->is_featured)
                <span style="position:absolute;top:12px;left:12px;background:#ec4899;color:white;font-size:10px;font-weight:700;padding:4px 10px;border-radius:20px;">Featured</span>
                @endif
            </div>
            <div style="padding:20px;">
                <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:#ec4899;font-weight:700;text-transform:uppercase;margin-bottom:8px;">
                    <i class="fas fa-heart"></i>
                    <span>{{ $post->category?->name ?? 'Advice' }}</span>
                    <span style="color:#d1d5db;">•</span>
                    <span style="color:#9ca3af;font-weight:500;">{{ $post->reading_time ?? 5 }} min read</span>
                </div>
                <h5 style="font-weight:700;color:#1f2937;margin-bottom:8px;line-height:1.4;">{{ $post->title }}</h5>
                <p style="font-size:13px;color:#6b7280;line-height:1.6;margin-bottom:16px;">
                    {{ Str::limit($post->excerpt ?? strip_tags($post->body), 120) }}
                </p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:14px;border-top:1px solid rgba(236,72,153,0.08);">
                    <div style="display:flex;align-items:center;gap:8px;">
                        <img src="{{ $post->author->getAvatarUrl() }}" style="width:32px;height:32px;border-radius:50%;object-fit:cover;" alt="">
                        <span style="font-size:12px;font-weight:600;color:#374151;">{{ $post->author->name }}</span>
                    </div>
                    <a href="{{ route('member.blog.show', $post->slug) }}" style="color:#ec4899;font-weight:700;font-size:13px;text-decoration:none;">
                        Read More <i class="fas fa-arrow-right" style="font-size:10px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="glass-card text-center" style="padding:60px 20px;">
            <i class="fas fa-book-open" style="font-size:48px;color:#d1d5db;margin-bottom:16px;"></i>
            <h4 style="font-weight:700;color:#9ca3af;margin-bottom:8px;">Coming Soon</h4>
            <p style="color:#9ca3af;margin:0;">Our experts are preparing new articles for you.</p>
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($posts->hasPages())
<div class="mt-4 d-flex justify-content-center">
    {{ $posts->links() }}
</div>
@endif

@endsection
