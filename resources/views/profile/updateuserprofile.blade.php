@extends('layouts.user-layout')

@section('title', $profileUser->name . ' — Profile')
@section('page-title', 'Member Profile')

@section('content')

@php
    $profile = $profileUser->profile;
    $age = $profileUser->getAge();
@endphp

<div class="row g-4">
    <div class="col-lg-4">
        <div class="glass-card text-center" style="padding:32px 24px;">
            <img src="{{ $profileUser->getAvatarUrl() }}"
                 style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #ec4899;margin-bottom:16px;">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;color:#1f2937;margin-bottom:4px;">
                {{ $profile?->full_name ?: $profileUser->name }}
                @if($age), {{ $age }}@endif
            </h3>
            @if($profile?->city)
            <p style="color:#6b7280;font-size:14px;margin-bottom:12px;">
                <i class="fas fa-map-marker-alt me-1" style="color:#ec4899;"></i>
                {{ $profile->city }}{{ $profile->country ? ', '.$profile->country : '' }}
            </p>
            @endif

            @if(isset($match) && $match->compatibility_score)
            <div style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border-radius:16px;padding:16px;margin:16px 0;">
                <div style="font-size:32px;font-weight:800;">{{ $match->compatibility_score }}%</div>
                <div style="font-size:12px;opacity:0.9;">Compatibility Score</div>
            </div>
            @endif

            @if($profile?->is_verified)
            <span style="background:#d1fae5;color:#065f46;font-size:12px;font-weight:700;padding:4px 12px;border-radius:20px;">
                <i class="fas fa-check-circle me-1"></i>Verified
            </span>
            @endif

            @if($profile?->personality_type)
            <div style="margin-top:16px;padding-top:16px;border-top:1px solid rgba(236,72,153,0.1);">
                <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;">Personality Type</div>
                <div style="font-weight:700;color:#a855f7;font-size:14px;">{{ $profile->personality_type }}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="col-lg-8">
        <div class="glass-card mb-4" style="padding:28px;">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:16px;"><i class="fas fa-user me-2" style="color:#ec4899;"></i>About</h5>
            <p style="font-size:15px;color:#374151;line-height:1.8;">{{ $profile?->bio ?? 'No bio provided yet.' }}</p>
        </div>

        <div class="row g-3 mb-4">
            @foreach([
                ['Occupation', $profile?->occupation, 'fa-briefcase'],
                ['Education', $profile?->education, 'fa-graduation-cap'],
                ['Relationship Goal', $profile?->relationship_goal ? ucfirst(str_replace('_', ' ', $profile->relationship_goal)) : null, 'fa-heart'],
                ['Religion', $profile?->religion, 'fa-pray'],
            ] as [$label, $value, $icon])
            @if($value)
            <div class="col-md-6">
                <div class="glass-card" style="padding:16px 20px;">
                    <div style="font-size:12px;color:#9ca3af;margin-bottom:4px;"><i class="fas {{ $icon }} me-1"></i>{{ $label }}</div>
                    <div style="font-weight:600;color:#1f2937;font-size:14px;">{{ $value }}</div>
                </div>
            </div>
            @endif
            @endforeach
        </div>

        @if($profile?->interests && count($profile->interests))
        <div class="glass-card mb-4" style="padding:24px;">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:14px;"><i class="fas fa-star me-2" style="color:#ec4899;"></i>Interests</h5>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                @foreach($profile->interests as $interest)
                <span style="background:#fce7f3;color:#ec4899;font-size:13px;font-weight:600;padding:6px 14px;border-radius:20px;">{{ $interest }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            @if(isset($match) && $match->status === 'accepted')
            <a href="{{ route('member.chat.show', $match->id) }}" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;text-decoration:none;padding:12px 24px;border-radius:12px;font-weight:700;font-size:14px;">
                <i class="fas fa-comment me-2"></i>Send Message
            </a>
            @endif
            <a href="{{ url()->previous() }}" style="background:#f3f4f6;color:#6b7280;text-decoration:none;padding:12px 24px;border-radius:12px;font-weight:600;font-size:14px;">
                <i class="fas fa-arrow-left me-2"></i>Go Back
            </a>
        </div>
    </div>
</div>

@endsection
