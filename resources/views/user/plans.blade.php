{{-- resources/views/user/plans.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Premium Plans')
@section('page-title', 'Premium Plans')

@section('content')

{{-- Header --}}
<div style="text-align:center;margin-bottom:40px;">
    <div style="display:inline-block;background:linear-gradient(135deg,#fce7f3,#f3e8ff);border-radius:20px;padding:10px 24px;margin-bottom:16px;">
        <span style="font-size:13px;font-weight:700;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
            <i class="fas fa-crown me-2"></i>UPGRADE YOUR EXPERIENCE
        </span>
    </div>
    <h2 style="font-family:'Playfair Display',serif;font-size:32px;font-weight:700;color:#1f2937;margin-bottom:12px;">
        Find Love Faster
    </h2>
    <p style="font-size:15px;color:#6b7280;max-width:500px;margin:0 auto 24px;">
        Unlock powerful features designed to help you find your perfect match sooner.
    </p>

    {{-- Billing Toggle --}}
    <div style="display:inline-flex;background:#f3f4f6;border-radius:25px;padding:4px;gap:4px;">
        <button id="btn-monthly" onclick="toggleBilling('monthly')"
                style="padding:8px 20px;border-radius:20px;border:none;font-size:13px;font-weight:700;cursor:pointer;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;">
            Monthly
        </button>
        <button id="btn-yearly" onclick="toggleBilling('yearly')"
                style="padding:8px 20px;border-radius:20px;border:none;font-size:13px;font-weight:700;cursor:pointer;background:transparent;color:#6b7280;">
            Yearly
            <span style="background:#22c55e;color:white;font-size:10px;padding:2px 8px;border-radius:20px;margin-left:6px;">Save 33%</span>
        </button>
    </div>
</div>

{{-- Plans Grid --}}
{{-- Plans from database --}}
<div class="row g-3 justify-content-center mb-5">
    @forelse($plans as $plan)
    @php
        $limits = [];
        if (!$plan->can_see_who_liked) $limits[] = 'See who liked you';
        if (!$plan->can_boost_profile) $limits[] = 'Profile boost';
        if (!$plan->has_video_chat) $limits[] = 'Video chat';
        if (!$plan->has_advanced_filter) $limits[] = 'Advanced filters';
        $features = $plan->features ?? [];
    @endphp
    <div class="col-md-6 col-xl-3">
        <div style="background:{{ $plan->is_featured ? 'linear-gradient(135deg,#1f2937,#374151)' : 'rgba(255,255,255,0.9)' }};
                    backdrop-filter:blur(16px);
                    border-radius:24px;
                    border:{{ $plan->is_featured ? '2px solid #ec4899' : '1.5px solid rgba(236,72,153,0.15)' }};
                    padding:28px;
                    position:relative;
                    height:100%;
                    display:flex;flex-direction:column;
                    box-shadow:{{ $plan->is_featured ? '0 20px 60px rgba(236,72,153,0.25)' : '0 4px 20px rgba(0,0,0,0.05)' }};
                    transition:transform .2s;"
             onmouseover="this.style.transform='translateY(-4px)'"
             onmouseout="this.style.transform='translateY(0)'">

            @if($plan->is_featured)
            <div style="position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-size:11px;font-weight:800;padding:5px 18px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;white-space:nowrap;">
                ⭐ Most Popular
            </div>
            @endif

            {{-- Plan Header --}}
            <div style="margin-bottom:20px;">
                <div style="width:44px;height:44px;border-radius:14px;background:{{ $plan->badge_color }}22;display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
                    <i class="fas fa-crown" style="color:{{ $plan->badge_color }};font-size:18px;"></i>
                </div>
                <h5 style="font-weight:800;color:{{ $plan->is_featured ? 'white' : '#1f2937' }};margin-bottom:4px;">{{ $plan->name }}</h5>

                <div style="display:flex;align-items:baseline;gap:4px;margin-top:8px;">
                    @if($plan->price_monthly > 0)
                    <span class="price-monthly" style="font-size:32px;font-weight:800;color:{{ $plan->is_featured ? 'white' : '#1f2937' }};">
                        ${{ $plan->price_monthly }}
                    </span>
                    <span class="price-yearly" style="font-size:32px;font-weight:800;color:{{ $plan->is_featured ? 'white' : '#1f2937' }};display:none;">
                        ${{ round($plan->price_yearly / 12, 2) }}
                    </span>
                    <span style="font-size:13px;color:{{ $plan->is_featured ? 'rgba(255,255,255,0.7)' : '#9ca3af' }};">/mo</span>
                    @else
                    <span style="font-size:32px;font-weight:800;color:{{ $plan->is_featured ? 'white' : '#1f2937' }};">Free</span>
                    @endif
                </div>
                <div class="price-yearly-total" style="display:none;font-size:12px;color:{{ $plan->is_featured ? 'rgba(255,255,255,0.7)' : '#9ca3af' }};">
                    @if($plan->price_yearly > 0) ${{ $plan->price_yearly }}/year @endif
                </div>
            </div>

            {{-- Features --}}
            <div style="flex:1;">
                @foreach($features as $feature)
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                    <i class="fas fa-check-circle" style="color:#22c55e;font-size:14px;flex-shrink:0;"></i>
                    <span style="font-size:13px;color:{{ $plan->is_featured ? 'rgba(255,255,255,0.9)' : '#374151' }};">{{ $feature }}</span>
                </div>
                @endforeach

                @foreach($limits as $limit)
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;opacity:0.4;">
                    <i class="fas fa-times-circle" style="color:#9ca3af;font-size:14px;flex-shrink:0;"></i>
                    <span style="font-size:13px;color:{{ $plan->is_featured ? 'rgba(255,255,255,0.6)' : '#9ca3af' }};">{{ $limit }}</span>
                </div>
                @endforeach
            </div>

            {{-- CTA --}}
            <div style="margin-top:20px;">
                @if($plan->price_monthly === 0)
                <div style="text-align:center;padding:12px;border-radius:12px;background:{{ $plan->is_featured ? 'rgba(255,255,255,0.1)' : '#f3f4f6' }};color:{{ $plan->is_featured ? 'rgba(255,255,255,0.7)' : '#9ca3af' }};font-size:13px;font-weight:600;">
                    Current Plan
                </div>
                @else
                <button onclick="choosePlan('{{ $plan->slug }}')"
                        style="width:100%;padding:13px;border-radius:14px;border:none;
                               background:{{ $plan->is_featured ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'transparent' }};
                               {{ !$plan->is_featured ? 'border:2px solid '.$plan->badge_color.';' : '' }}
                               color:{{ $plan->is_featured ? 'white' : $plan->badge_color }};
                               font-size:14px;font-weight:700;cursor:pointer;transition:all .2s;
                               {{ $plan->is_featured ? 'box-shadow:0 4px 14px rgba(236,72,153,0.4);' : '' }}">
                    Get {{ $plan->name }}
                </button>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">No plans available yet.</div>
    @endforelse
</div>

{{-- Trust Badges --}}
<div class="glass-card">
    <div class="row text-center g-3">
        @foreach([
            ['fa-shield-halved','Secure Payment','SSL encrypted checkout'],
            ['fa-rotate-left','Cancel Anytime','No contracts or commitments'],
            ['fa-headset','24/7 Support','We\'re here when you need us'],
            ['fa-heart','Love Guarantee','Find meaningful connections'],
        ] as [$icon,$title,$sub])
        <div class="col-6 col-md-3">
            <i class="fas {{ $icon }} fa-2x mb-2 d-block" style="color:#ec4899;"></i>
            <div style="font-weight:700;font-size:13px;color:#1f2937;">{{ $title }}</div>
            <div style="font-size:12px;color:#9ca3af;margin-top:2px;">{{ $sub }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- Payment notice modal --}}
<div id="paymentNotice" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;padding:20px;">
    <div style="background:white;border-radius:24px;padding:32px;max-width:420px;width:100%;text-align:center;">
        <div style="font-size:40px;margin-bottom:12px;">💳</div>
        <h3 style="font-weight:700;color:#1f2937;margin-bottom:8px;">Payment Coming Soon</h3>
        <p style="color:#6b7280;font-size:14px;margin-bottom:20px;">
            The <strong id="paymentPlanName"></strong> plan will be available once payment is connected to a live API (Stripe/PayPal).
        </p>
        <button type="button" onclick="closePaymentNotice()" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-weight:700;cursor:pointer;">Got it</button>
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleBilling(type) {
    const isYearly = type === 'yearly';
    document.getElementById('btn-monthly').style.background = isYearly ? 'transparent' : 'linear-gradient(135deg,#ec4899,#a855f7)';
    document.getElementById('btn-monthly').style.color      = isYearly ? '#6b7280' : 'white';
    document.getElementById('btn-yearly').style.background  = isYearly ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'transparent';
    document.getElementById('btn-yearly').style.color       = isYearly ? 'white' : '#6b7280';

    document.querySelectorAll('.price-monthly').forEach(el => el.style.display = isYearly ? 'none' : 'inline');
    document.querySelectorAll('.price-yearly').forEach(el => el.style.display  = isYearly ? 'inline' : 'none');
    document.querySelectorAll('.price-yearly-total').forEach(el => el.style.display = isYearly ? 'block' : 'none');
}

function choosePlan(slug) {
    document.getElementById('paymentNotice').style.display = 'flex';
    document.getElementById('paymentPlanName').textContent = slug.charAt(0).toUpperCase() + slug.slice(1);
}
function closePaymentNotice() {
    document.getElementById('paymentNotice').style.display = 'none';
}
</script>
@endpush