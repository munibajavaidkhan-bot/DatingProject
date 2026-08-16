<!doctype html>
<html lang="en">
<head>
    <title>Pricing - The Love Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find your perfect match with our 52-week journey to meaningful connections. Choose the plan that fits your love story.">

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/css/m-style.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/site-header-footer.css" rel="stylesheet">

    <style>
        .inner-header {
            padding: 80px 0 90px;
            background: linear-gradient(135deg, #e33054 0%, #ff5277 100%);
            color: white;
            text-align: center;
        }
        .inner-header h1 { color: white; font-weight: 800; font-size: 3rem; }
        .page-content-wrapper { padding: 60px 0; }
    </style>
</head>
<body>

    <!-- Navigation -->
    @include('partials.site-header', ['active' => 'home'])

    <!-- Header -->
    <div class="inner-header">
        <div class="container">
            <span class="badge bg-white text-danger px-3 py-2 rounded-pill mb-3 shadow-sm">
                <i class="fas fa-crown me-1"></i> UPGRADE YOUR EXPERIENCE
            </span>
            <h1>Find Love Faster</h1>
            <p class="lead">Unlock powerful features designed to help you find your perfect match sooner.</p>

            <div style="display:inline-flex;background:rgba(255,255,255,0.2);border-radius:25px;padding:4px;gap:4px;margin-top:10px;">
                <button id="btn-monthly" onclick="toggleBilling('monthly')"
                        style="padding:8px 20px;border-radius:20px;border:none;font-size:13px;font-weight:700;cursor:pointer;background:#ffffff;color:#e33054;">
                    Monthly
                </button>
                <button id="btn-yearly" onclick="toggleBilling('yearly')"
                        style="padding:8px 20px;border-radius:20px;border:none;font-size:13px;font-weight:700;cursor:pointer;background:transparent;color:white;">
                    Yearly
                    <span style="background:#22c55e;color:white;font-size:10px;padding:2px 8px;border-radius:20px;margin-left:6px;">Save 33%</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Plans -->
    <div class="page-content-wrapper">
        <div class="container">
            <div class="row g-4 justify-content-center">
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

                        <div style="margin-top:20px;">
                            <a href="{{ route('register') }}"
                               style="display:block;text-align:center;padding:13px;border-radius:14px;text-decoration:none;
                                      background:{{ $plan->is_featured ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'transparent' }};
                                      {{ !$plan->is_featured ? 'border:2px solid '.$plan->badge_color.';' : '' }}
                                      color:{{ $plan->is_featured ? 'white' : $plan->badge_color }};
                                      font-size:14px;font-weight:700;transition:all .2s;
                                      {{ $plan->is_featured ? 'box-shadow:0 4px 14px rgba(236,72,153,0.4);' : '' }}">
                                {{ $plan->price_monthly === 0 ? 'Start Free' : 'Get '.$plan->name }}
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">No plans available yet.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.site-footer', ['active' => 'home'])

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleBilling(type) {
            const isYearly = type === 'yearly';
            document.getElementById('btn-monthly').style.background = isYearly ? 'transparent' : '#ffffff';
            document.getElementById('btn-monthly').style.color      = isYearly ? 'white' : '#e33054';
            document.getElementById('btn-yearly').style.background  = isYearly ? '#ffffff' : 'transparent';
            document.getElementById('btn-yearly').style.color       = isYearly ? '#e33054' : 'white';

            document.querySelectorAll('.price-monthly').forEach(el => el.style.display = isYearly ? 'none' : 'inline');
            document.querySelectorAll('.price-yearly').forEach(el => el.style.display  = isYearly ? 'inline' : 'none');
            document.querySelectorAll('.price-yearly-total').forEach(el => el.style.display = isYearly ? 'block' : 'none');
        }
    </script>
</body>
</html>
