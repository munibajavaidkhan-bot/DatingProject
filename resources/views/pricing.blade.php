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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/assets/css/m-style.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <style>
        .inner-header {
            padding: 160px 0 90px;
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
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/assets/images/love_logo.png" alt="The Love Project" height="50">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#testimonials">Success Stories</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('pricing') }}">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('terms') }}">Terms</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('privacy') }}">Privacy</a></li>
                    <li class="nav-item"><a class="nav-link btn-primary ms-3" href="{{ url('/login') }}" style="color:white !important; padding:10px 25px; border-radius:30px;">My Account</a></li>
                </ul>
            </div>
        </div>
    </nav>

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
    <footer class="footer-section">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <img src="/assets/images/love_logo.png" alt="The Love Project" class="img-fluid" style="filter: brightness(0) invert(1);">
                        </div>
                        <p>52 Weeks to Forever — lessons, quizzes & curated matches for meaningful, long-lasting love. Join us in finding your perfect story.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="/">About Us</a></li>
                            <li><a href="/#how-it-works">How It Works</a></li>
                            <li><a href="/#testimonials">Success Stories</a></li>
                            <li><a href="{{ route('pricing') }}">Pricing</a></li>
                            <li><a href="{{ route('member.blog') }}">Blog</a></li>
                            <li><a href="/">Contact</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h4>Features</h4>
                        <ul>
                            <li><a href="{{ route('member.content') }}">52 Weekly Lessons</a></li>
                            <li><a href="{{ route('member.quiz') }}">Love Quiz</a></li>
                            <li><a href="{{ route('member.matches') }}">Personality Matches</a></li>
                            <li><a href="{{ route('member.forum') }}">Social Corner</a></li>
                            <li><a href="{{ route('member.discover') }}">Private Journals</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="footer-widget">
                        <h4>Newsletter</h4>
                        <p>Don't miss out on love tips, success stories, and exclusive offers.</p>
                        <div class="newsletter-form">
                            <form>
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Your Email">
                                    <button class="btn" type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Footer Bottom -->
    <div class="ftr-btm">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">© 2018-2026 The Love Project. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <ul>
                        <li><a href="{{ route('terms') }}">Terms</a></li>
                        <li><a href="{{ route('privacy') }}">Privacy</a></li>
                        <li><a href="#">Cookies</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

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
