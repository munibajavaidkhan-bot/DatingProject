<!doctype html>
<html lang="en">
<head>
    <title>The Love Project - Find Your Perfect Match</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Find your perfect match with our 52-week journey to meaningful connections. Join the love project today.">
    <meta name="keywords" content="dating, relationship, love, matchmaking, soulmate">
    
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
    
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/m-style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/newcss.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/site-header-footer.css') }}" rel="stylesheet">
    
    <!-- WOW.js Animation CSS -->
    <style>
        .wow {
            visibility: hidden;
        }
        .animated {
            visibility: visible !important;
        }
    </style>
</head>
<body>

    <!-- No Script Warning -->
    <noscript>
        <div class="alert alert-warning text-center m-0 rounded-0">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Javascript is disabled. Please enable it for better working experience.
        </div>
    </noscript>

    <!-- Page Loader -->
    <div id="page-loader">
        <div class="loader-content">
            <div class="loader-spinner"></div>
            <h2>The Love Project</h2>
            <p>Loading your soulmate experience...</p>
        </div>
    </div>

    <!-- Navigation -->
    @include('partials.site-header', ['active' => 'home'])

    <main>

        <!-- Hero Section -->
        <section class="home-bannerwrp" id="home">
            <video autoplay muted loop playsinline class="banner-bg-video">
                <source src="{{ asset('assets/videos/dessds.mp4') }}" type="video/mp4">
            </video>
            
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h1 class="wow animate-slide-up" data-wow-duration="1s">
                            Find Your Story <br>
                            <span class="animate-float">52 Weeks to Forever</span>
                        </h1>
                        
                        <div class="form-wrapper wow animate-slide-up" data-wow-duration="1s" data-wow-delay="0.3s">
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <i class="fas fa-search"></i>
                                            <input type="text" class="form-control" placeholder="Find Your Love">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <input type="text" class="form-control" placeholder="Location">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-search">
                                            <i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="firstfldwrp">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="feature-image wow animate-zoom" data-wow-duration="1s">
                            <img src="{{ asset('assets/images/romantic-couple-taking-selfie-together-on-the-beac-2025-04-02-14-25-57-utc.jpg') }}" alt="Romantic Couple" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title text-start wow animate-slide-right" data-wow-duration="1s">
                            <h2>Dating Better <span>Than Ever Before</span></h2>
                            <p class="main-pera">Create meaningful connections with our advanced matching algorithm. We go beyond superficial swipes to help you find genuine compatibility based on values, interests, and life goals.</p>
                            <p class="main-pera">Our platform offers a safe, private space where you can be yourself and connect with like-minded individuals who share your vision for a lasting relationship.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Steps Section -->
        <section class="philosophywrp" id="how-it-works">
            <div class="container">
                <div class="section-title">
                    <h2 class="wow animate-slide-up" data-wow-duration="1s">How It Works: <span>3 Simple Steps</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s">
                            <img src="{{ asset('assets/images/43434343.png') }}" alt="Create Profile" class="animate-float">
                            <h4>Create Your Profile</h4>
                            <p>Share your authentic self - your values, passions, and life journey. We believe in real connections, not just perfect profiles.</p>
                            <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.2s">
                            <img src="{{ asset('assets/images/2121.png') }}" alt="Take Quiz" class="animate-float">
                            <h4>Take the Love Quiz</h4>
                            <p>Discover your relationship style through our psychology-based assessment. Find matches that truly complement your personality.</p>
                            <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
                            <img src="{{ asset('assets/images/ewewe.png') }}" alt="Meet Match" class="animate-float">
                            <h4>Meet Your Match</h4>
                            <p>Receive curated matches weekly and start meaningful conversations with people who share your vision for love and connection.</p>
                            <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="proofbox">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="wow animate-slide-up" data-wow-duration="1s">Ready to start your 52‑week Journey?</h2>
                        <p class="wow animate-slide-up" data-wow-duration="1s" data-wow-delay="0.2s">Sign up now and take the first step towards a meaningful connection that could change your life forever.</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
                            Join Free Today
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Create Account Section -->
        <section class="creatacc-wrp">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="image-grid">
                            <img src="{{ asset('assets/images/ffdfdffd.jpg') }}" alt="Create Account" class="main-image img-fluid wow animate-slide-left" data-wow-duration="1s">
                            <img src="{{ asset('assets/images/dsdsdsdds.png') }}" alt="Icon" class="floating-image-1 wow animate-zoom" data-wow-duration="0.8s" data-wow-delay="1s">
                            <img src="{{ asset('assets/images/3rd-fold-right-icon.png') }}" alt="Icon" class="floating-image-2 wow animate-zoom" data-wow-duration="0.8s" data-wow-delay="1.3s">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title text-start wow animate-slide-right" data-wow-duration="1s">
                            <h2><span>Create</span> An Account</h2>
                            <p class="main-pera">Create an account today and start discovering the perfect partner who truly aligns with your personality, interests, and preferences.</p>
                            <p class="main-pera">By joining our platform, you get access to genuine profiles, smart matching tools, and a safe space to connect with people who share your values.</p>
                            <p class="main-pera">Sign up now for free and begin your journey toward building deep, meaningful, and lasting connections.</p>
                            <div class="mt-4">
                                <a href="{{ route('register') }}" class="btn btn-primary px-5 py-3 rounded-pill fw-bold" style="margin-right:12px;">Join Free Today</a>
                                <a href="{{ url('/login') }}" class="btn btn-outline-secondary px-4 py-3 rounded-pill fw-semibold">Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- People Section -->
<section class="peoplewrp">
  <div class="container">
    <div class="row">
      <div class="col-md-4 my-auto">
        <div class="txtwrp wow fadeInLeft" data-wow-duration="1s">
          <h2 class="main-heading">Welcome to This <span>Great Invention</span> of Love!</h2>
          <p class="main-pera">Welcome to this amazing invention by Love! Here, you'll discover smarter ways to navigate relationships, build stronger connections, and truly understand the language of love. Get ready for a journey that brings clarity, joy, and emotional growth.</p>
        </div>
        <div class="btnwrp wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
          <a class="btn-1" href="{{ route('register') }}">Get Started Now</a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="circular-professions">
          <!-- Center Circle -->
          <div class="center-circle">
            <img src="{{ asset('assets/images/circle.png') }}" alt="Love Circle" class="rotating-circle">
          </div>
          
          <!-- Profession Cards in Circle Layout -->
          <div class="profession-card card-1 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.2s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-1.png') }}" alt="Fashion Designer">
              <h4>Fashion Designer</h4>
            </div>
          </div>

          <div class="profession-card card-2 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.4s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-2.png') }}" alt="Business Developer">
              <h4>Business Developer</h4>
            </div>
          </div>

          <div class="profession-card card-3 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.6s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-3.png') }}" alt="Sales Man">
              <h4>Sales Man</h4>
            </div>
          </div>

          <div class="profession-card card-4 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.8s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-4.png') }}" alt="Copy Writer">
              <h4>Copy Writer</h4>
            </div>
          </div>

          <div class="profession-card card-5 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="1.0s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-5.png') }}" alt="Machine Operator">
              <h4>Machine Operator</h4>
            </div>
          </div>

          <div class="profession-card card-6 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="1.2s">
            <div class="card-content">
              <img src="{{ asset('assets/images/img-6.png') }}" alt="Professional Chef">
              <h4>Professional Chef</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        <!-- Features Grid -->
        <section class="vacanciewrp" id="features">
            <div class="container">
                <div class="section-title">
                    <h2 class="wow animate-slide-up" data-wow-duration="1s">The #1 Trusted <span>Dating Platform</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s">
                            <img src="{{ asset('assets/images/review.svg') }}" alt="Community">
                            <h4>Awesome Community</h4>
                            <p>Join millions of authentic singles looking for real connections and meaningful relationships.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img src="{{ asset('assets/images/network.svg') }}" alt="Members">
                            <h4>10M+ Members</h4>
                            <p>Connect with a diverse, global community of like-minded individuals seeking lasting love.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.2s">
                            <img src="{{ asset('assets/images/laptop.svg') }}" alt="Groups">
                            <h4>Private Groups</h4>
                            <p>Join exclusive communities based on your interests, hobbies, and relationship goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.3s">
                            <img src="{{ asset('assets/images/chat.svg') }}" alt="Forums">
                            <h4>Friendly Forums</h4>
                            <p>Engage in meaningful discussions and get relationship advice from our community.</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="feature-card featured text-center wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.4s">
                            <h4>Explore More Features</h4>
                            <p class="mb-0">Discover all the ways we help you find meaningful connections</p>
                            <i class="fas fa-arrow-right mt-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testiwrp" id="testimonials">
            <div class="container">
                <div class="section-title">
                    <h2 class="text-white">What They're <span>Saying</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s">
                            <img src="{{ asset('assets/images/testi-1.png') }}" alt="Elton J. Dennie">
                            <p>"I never thought I'd find someone who truly understands me. The Love Project's matching algorithm is incredible - it connected me with my soulmate in just weeks!"</p>
                            <h5>Elton J. Dennie</h5>
                            <span>Happy Member</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.2s">
                            <img src="{{ asset('assets/images/testi-2.png') }}" alt="Sarah J. Parker">
                            <p>"The 52-week journey transformed how I approach relationships. The weekly lessons and quizzes helped me understand myself and what I truly want in a partner."</p>
                            <h5>Sarah J. Parker</h5>
                            <span>Premium Member</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.4s">
                            <img src="{{ asset('assets/images/testi-3.png') }}" alt="Michael R. Smith">
                            <p>"Finally, a dating platform that focuses on quality over quantity! I met my fiancé here, and we're getting married next spring. Thank you, Love Project!"</p>
                            <h5>Michael R. Smith</h5>
                            <span>Success Story</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Packages -->
        <section class="videos-packageswrp">
            <div class="container">
                <div class="section-title">
                    <h4 class="text-primary">What Makes Us Different?</h4>
                    <h2>Built on Self-Discovery & <span>Intentional Connection</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s">
                            <img src="{{ asset('assets/images/222.webp') }}" alt="52 Weekly Lessons">
                            <div class="package-content">
                                <h3>52 Weekly Lessons</h3>
                                <p>Short, practical self-development lessons to help you grow emotionally and communicate better in relationships.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.2s">
                            <img src="{{ asset('assets/images/23232.webp') }}" alt="Deep Personality Matches">
                            <div class="package-content">
                                <h3>Deep Personality Matches</h3>
                                <p>Matches based on values, emotional intelligence, and long-term compatibility - not just appearance or superficial interests.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
                            <img src="{{ asset('assets/images/istockphoto-1338846887-170667a.jpg') }}" alt="Safe & Private Chat">
                            <div class="package-content">
                                <h3>Safe & Private Chat</h3>
                                <p>Double-moderated environment with AI protection and human moderation to keep your experience positive and secure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.6s">
                            <img src="{{ asset('assets/images/r2-.jpg') }}" alt="Quality Over Quantity">
                            <div class="package-content">
                                <h3>Quality Over Quantity</h3>
                                <p>We focus on meaningful matches rather than endless swiping, respecting your time and emotional investment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include('partials.site-footer', ['active' => 'home'])

    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/mlib.js') }}"></script>
    <script src="{{ asset('assets/js/functions.js') }}"></script>
    <script src="{{ asset('assets/js/canvas.js') }}"></script>
    
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hide');
            }, 800);
        });

        // Header Scroll Effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.site-header');
            if (header && window.scrollY > 100) {
                header.classList.add('sticky');
            } else if (header) {
                header.classList.remove('sticky');
            }
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#!' || href.startsWith('/#')) return;
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                        navbarCollapse.classList.remove('show');
                    }
                }
            });
        });

        // Lenis Smooth Scroll
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smooth: true
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    </script>

    {{-- Age Disclaimer Modal --}}
    @if(!session('age_verified'))
    <div id="ageModal" style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.8);display:flex;align-items:center;justify-content:center;">
        <div style="background:white;border-radius:24px;padding:40px;max-width:440px;width:90%;box-shadow:0 25px 60px rgba(0,0,0,0.4);text-align:center;">
            <div style="width:72px;height:72px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                <i class="fas fa-heart" style="font-size:32px;color:white;"></i>
            </div>
            <h2 style="color:#1f2937;font-size:22px;font-weight:700;margin-bottom:8px;">Age Verification Required</h2>
            <p style="color:#6b7280;font-size:14px;line-height:1.7;margin-bottom:24px;">
                This website contains age-restricted content. By entering, you confirm that you are at least <strong>18 years of age</strong>.
            </p>
            <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:14px;margin-bottom:24px;">
                <p style="color:#374151;font-size:12px;line-height:1.6;margin:0;">
                    By clicking "I Am 18+", you agree to our 
                    <a href="{{ route('terms') }}" style="color:#a855f7;">Terms & Conditions</a> and 
                    <a href="{{ route('privacy') }}" style="color:#a855f7;">Privacy Policy</a>.
                </p>
            </div>
            <div style="display:flex;gap:12px;">
                <button onclick="window.location.href='https://google.com'" style="flex:1;padding:12px;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:10px;color:#6b7280;font-size:14px;font-weight:500;cursor:pointer;">
                    I Am Under 18
                </button>
                <button onclick="verifyAge()" style="flex:1;padding:12px;background:linear-gradient(135deg,#ec4899,#a855f7);border:none;border-radius:10px;color:white;font-size:14px;font-weight:600;cursor:pointer;">
                    <i class="fas fa-check me-1"></i> I Am 18+
                </button>
            </div>
        </div>
    </div>

    <script>
        function verifyAge() {
            fetch('/verify-age', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            }).then(res => {
                if (res.ok) {
                    document.getElementById('ageModal').style.display = 'none';
                }
            });
        }
    </script>
    @endif
    
</body>
</html>