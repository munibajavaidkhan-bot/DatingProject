@extends('layouts.user-layout')

@section('title', 'Profile Under Review')

@section('content')
<div style="max-width:500px;margin:60px auto;text-align:center;">
    <div style="background:#1a1a24;border:1px solid rgba(255,255,255,0.06);border-radius:20px;padding:48px 36px;">
        <div style="width:80px;height:80px;border-radius:50%;background:rgba(251,191,36,0.15);display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
            <i class="fas fa-clock" style="font-size:36px;color:#fbbf24;"></i>
        </div>
        <h1 style="color:#e5e7eb;font-size:24px;font-weight:700;margin-bottom:12px;">Profile Under Review</h1>
        <p style="color:#9ca3af;font-size:15px;line-height:1.7;margin-bottom:32px;">
            Thank you for completing your profile! Our team is reviewing it to ensure everything looks great. 
            You'll be able to access all features once your profile is approved.
        </p>
        <div style="background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.2);border-radius:12px;padding:16px;margin-bottom:28px;">
            <p style="color:#fbbf24;font-size:13px;margin:0;">
                <i class="fas fa-info-circle me-1"></i>
                This usually takes 1-24 hours. We'll notify you once approved.
            </p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1);color:#9ca3af;padding:10px 24px;border-radius:10px;font-size:14px;cursor:pointer;">
                <i class="fas fa-right-from-bracket me-2"></i> Sign Out
            </button>
        </form>
    </div>
</div>
@endsection
