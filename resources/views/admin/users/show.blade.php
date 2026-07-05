@extends('layouts.admin-layout')

@section('title', 'User Profile')
@section('page-title', $user->name)

@section('content')

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center">
            <img src="{{ $user->getAvatarUrl() }}" style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #ec4899;margin-bottom:16px;">
            <h5 style="color:white;font-weight:700;">{{ $user->name }}</h5>
            <p style="color:#9ca3af;font-size:13px;">{{ $user->email }}</p>
            <div style="margin-top:12px;">
                <span style="background:rgba(236,72,153,0.15);color:#ec4899;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;text-transform:capitalize;">{{ $user->role }}</span>
                <span style="background:rgba(34,197,94,0.15);color:#22c55e;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;text-transform:capitalize;margin-left:6px;">{{ $user->status }}</span>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="admin-card">
            <h5 style="color:white;font-weight:700;margin-bottom:20px;">Profile Details</h5>
            <div class="row g-3">
                @foreach([
                    ['Age', $user->getAge()],
                    ['City', $user->profile?->city],
                    ['Gender', $user->profile?->gender],
                    ['Profile', $user->profile?->is_complete ? 'Complete' : 'Incomplete'],
                    ['Personality', $user->profile?->personality_type],
                    ['Quiz Answers', $user->quizAnswers->count()],
                    ['Joined', $user->created_at->format('M d, Y')],
                ] as [$label, $value])
                <div class="col-md-6">
                    <div style="padding:12px 0;border-bottom:1px solid rgba(255,255,255,0.06);">
                        <div style="font-size:12px;color:#6b7280;">{{ $label }}</div>
                        <div style="color:white;font-size:14px;font-weight:600;">{{ $value ?? '—' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($user->profile?->bio)
            <div style="margin-top:20px;">
                <div style="font-size:12px;color:#6b7280;margin-bottom:6px;">Bio</div>
                <p style="color:#d1d5db;font-size:14px;line-height:1.6;">{{ $user->profile->bio }}</p>
            </div>
            @endif
            <div style="margin-top:24px;">
                <a href="{{ route('admin.users.edit', $user->id) }}" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;padding:10px 20px;border-radius:10px;font-size:13px;font-weight:600;">
                    <i class="fas fa-edit me-2"></i>Edit User
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
