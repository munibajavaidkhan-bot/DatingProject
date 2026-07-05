@extends('layouts.user-layout')

@section('title', $post->title)
@section('page-title', 'Expert Advice')

@section('content')

<div class="row g-4">
    <div class="col-lg-8">
        <div class="glass-card mb-4">
            @if($post->category)
            <span style="background:{{ $post->category->color }}22;color:{{ $post->category->color }};font-size:12px;font-weight:700;padding:4px 12px;border-radius:20px;">
                {{ $post->category->name }}
            </span>
            @endif

            <h1 style="font-family:'Playfair Display',serif;font-size:30px;font-weight:700;color:#1f2937;margin:16px 0 12px;line-height:1.3;">
                {{ $post->title }}
            </h1>

            <div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid rgba(236,72,153,0.08);flex-wrap:wrap;">
                <img src="{{ $post->author->getAvatarUrl() }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                <div>
                    <div style="font-weight:700;font-size:14px;color:#1f2937;">{{ $post->author->name }}</div>
                    <div style="font-size:12px;color:#9ca3af;">
                        {{ $post->published_at?->format('M d, Y') }} · {{ $post->reading_time }} min read · {{ $post->views }} views
                    </div>
                </div>
            </div>

            @if($post->excerpt)
            <p style="font-size:17px;color:#4b5563;font-style:italic;line-height:1.7;margin-bottom:24px;border-left:3px solid #ec4899;padding-left:16px;">
                {{ $post->excerpt }}
            </p>
            @endif

            <div style="font-size:16px;color:#374151;line-height:1.9;">
                {!! $post->body !!}
            </div>
        </div>

        {{-- Comments --}}
        <div class="glass-card mb-4">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">
                <i class="fas fa-comments me-2" style="color:#ec4899;"></i>
                Comments ({{ $post->comments->count() }})
            </h5>

            <form action="{{ route('member.blog.comment', $post->id) }}" method="POST" style="margin-bottom:24px;">
                @csrf
                <textarea name="body" rows="3" placeholder="Share your thoughts..." required
                          style="width:100%;padding:14px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;resize:vertical;margin-bottom:12px;"></textarea>
                <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:10px 20px;font-weight:600;cursor:pointer;">
                    Post Comment
                </button>
            </form>

            @forelse($post->comments as $comment)
            <div style="display:flex;gap:12px;padding:16px 0;border-top:1px solid rgba(236,72,153,0.06);">
                <img src="{{ $comment->user->getAvatarUrl() }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;flex-shrink:0;">
                <div>
                    <div style="font-weight:700;font-size:14px;color:#1f2937;">{{ $comment->user->name }}
                        <span style="font-weight:400;font-size:12px;color:#9ca3af;margin-left:8px;">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p style="font-size:14px;color:#374151;line-height:1.6;margin:6px 0 0;">{{ $comment->body }}</p>
                </div>
            </div>
            @empty
            <p style="color:#9ca3af;font-size:14px;text-align:center;padding:20px;">No comments yet. Be the first!</p>
            @endforelse
        </div>
    </div>

    <div class="col-lg-4">
        <div class="glass-card mb-4">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:14px;">Related Articles</h6>
            @forelse($related as $rel)
            <a href="{{ route('member.blog.show', $rel->slug) }}" style="display:block;padding:12px 0;border-bottom:1px solid rgba(236,72,153,0.06);text-decoration:none;">
                <div style="font-weight:600;font-size:13px;color:#1f2937;line-height:1.4;margin-bottom:4px;">{{ Str::limit($rel->title, 60) }}</div>
                <div style="font-size:11px;color:#9ca3af;">{{ $rel->reading_time }} min read</div>
            </a>
            @empty
            <p style="font-size:13px;color:#9ca3af;">No related articles.</p>
            @endforelse
        </div>

        <a href="{{ route('member.blog') }}" style="display:block;text-align:center;background:#fce7f3;color:#ec4899;text-decoration:none;padding:12px;border-radius:12px;font-weight:600;font-size:14px;">
            <i class="fas fa-arrow-left me-2"></i>Back to Blog
        </a>
    </div>
</div>

@endsection
