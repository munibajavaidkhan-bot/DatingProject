@extends('layouts.user-layout')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('content')

<div style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:24px;padding:28px 32px;color:white;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:26px;font-weight:700;margin-bottom:4px;">Notifications</h2>
        <p style="opacity:0.9;font-size:14px;margin:0;">Stay updated on matches, messages, and community activity</p>
    </div>
    <form action="{{ route('member.notifications.readAll') }}" method="POST">
        @csrf
        <button type="submit" style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);border-radius:12px;padding:10px 18px;font-size:13px;font-weight:600;cursor:pointer;">
            Mark all read
        </button>
    </form>
</div>

<div class="glass-card" style="padding:0;overflow:hidden;">
    @forelse($notifications as $notification)
    <a href="{{ $notification->action_url ?? '#' }}"
       style="display:flex;align-items:flex-start;gap:16px;padding:20px 24px;text-decoration:none;border-bottom:1px solid rgba(236,72,153,0.06);transition:background .2s;"
       onmouseover="this.style.background='#fdf2f8'" onmouseout="this.style.background='transparent'">
        <div style="width:44px;height:44px;border-radius:50%;background:{{ $notification->color ?? '#ec4899' }}22;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            @if($notification->fromUser)
                <img src="{{ $notification->fromUser->getAvatarUrl() }}" style="width:44px;height:44px;border-radius:50%;object-fit:cover;">
            @else
                <i class="fas {{ $notification->icon ?? 'fa-bell' }}" style="color:{{ $notification->color ?? '#ec4899' }};"></i>
            @endif
        </div>
        <div style="flex:1;min-width:0;">
            <div style="font-weight:700;font-size:14px;color:#1f2937;margin-bottom:4px;">{{ $notification->title }}</div>
            <div style="font-size:13px;color:#6b7280;line-height:1.5;">{{ $notification->message }}</div>
            <div style="font-size:11px;color:#9ca3af;margin-top:6px;">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
        @if(!$notification->is_read)
        <span style="width:8px;height:8px;background:#ec4899;border-radius:50%;flex-shrink:0;margin-top:6px;"></span>
        @endif
    </a>
    @empty
    <div style="text-align:center;padding:60px 20px;color:#9ca3af;">
        <i class="fas fa-bell-slash fa-3x mb-3" style="color:#d1d5db;"></i>
        <h5 style="color:#6b7280;font-weight:600;">No notifications yet</h5>
        <p style="font-size:14px;">When you get matches or messages, they'll appear here.</p>
    </div>
    @endforelse
</div>

<div class="mt-4">{{ $notifications->links() }}</div>

@endsection
