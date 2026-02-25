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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Lenis Smooth Scroll -->
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>
    
    <!-- Custom CSS -->
    <link href="assets/css/m-style.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/newcss.css" rel="stylesheet">
    
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
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="assets/images/love_logo.png" alt="The Love Project" height="50">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <li><a class="dropdown-item" href="#">Logo Design</a></li>
                            <li><a class="dropdown-item" href="#">Web Development</a></li>
                            <li><a class="dropdown-item" href="#">SEO Services</a></li>
                            <li><a class="dropdown-item" href="#">Mobile Apps</a></li>
                            <li><a class="dropdown-item" href="#">Video Animation</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reseller</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Culture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-primary" href="{{ url('/login') }}">My Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>

        <!-- Hero Section -->
        <section class="home-bannerwrp" id="home">
            <video autoplay muted loop playsinline class="banner-bg-video">
                <source src="assets/videos/dessds.mp4" type="video/mp4">
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
                            <img src="assets/images/romantic-couple-taking-selfie-together-on-the-beac-2025-04-02-14-25-57-utc.jpg" alt="Romantic Couple" class="img-fluid">
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
        <section class="philosophywrp">
            <div class="container">
                <div class="section-title">
                    <h2 class="wow animate-slide-up" data-wow-duration="1s">How It Works: <span>3 Simple Steps</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s">
                            <img src="assets/images/43434343.png" alt="Create Profile" class="animate-float">
                            <h4>Create Your Profile</h4>
                            <p>Share your authentic self - your values, passions, and life journey. We believe in real connections, not just perfect profiles.</p>
                            <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.2s">
                            <img src="assets/images/2121.png" alt="Take Quiz" class="animate-float">
                            <h4>Take the Love Quiz</h4>
                            <p>Discover your relationship style through our psychology-based assessment. Find matches that truly complement your personality.</p>
                            <a href="#">Learn More <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="step-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
                            <img src="assets/images/ewewe.png" alt="Meet Match" class="animate-float">
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
                        <a href="#" class="btn btn-primary btn-lg wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
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
                            <img src="assets/images/ffdfdffd.jpg" alt="Create Account" class="main-image img-fluid wow animate-slide-left" data-wow-duration="1s">
                            <img src="assets/images/dsdsdsdds.png" alt="Icon" class="floating-image-1 wow animate-zoom" data-wow-duration="0.8s" data-wow-delay="1s">
                            <img src="assets/images/3rd-fold-right-icon.png" alt="Icon" class="floating-image-2 wow animate-zoom" data-wow-duration="0.8s" data-wow-delay="1.3s">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title text-start wow animate-slide-right" data-wow-duration="1s">
                            <h2><span>Create</span> An Account</h2>
                            <p class="main-pera">Create an account today and start discovering the perfect partner who truly aligns with your personality, interests, and preferences.</p>
                            <p class="main-pera">By joining our platform, you get access to genuine profiles, smart matching tools, and a safe space to connect with people who share your values.</p>
                            <p class="main-pera">Sign up now for free and begin your journey toward building deep, meaningful, and lasting connections.</p>
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
          <a class="btn-1" href="javascript:;">Get Started Now</a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="circular-professions">
          <!-- Center Circle -->
          <div class="center-circle">
            <img src="assets/images/circle.png" alt="Love Circle" class="rotating-circle">
          </div>
          
          <!-- Profession Cards in Circle Layout -->
          <div class="profession-card card-1 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.2s">
            <div class="card-content">
              <img src="assets/images/img-1.png" alt="Fashion Designer">
              <h4>Fashion Designer</h4>
            </div>
          </div>

          <div class="profession-card card-2 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.4s">
            <div class="card-content">
              <img src="assets/images/img-2.png" alt="Business Developer">
              <h4>Business Developer</h4>
            </div>
          </div>

          <div class="profession-card card-3 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.6s">
            <div class="card-content">
              <img src="assets/images/img-3.png" alt="Sales Man">
              <h4>Sales Man</h4>
            </div>
          </div>

          <div class="profession-card card-4 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="0.8s">
            <div class="card-content">
              <img src="assets/images/img-4.png" alt="Copy Writer">
              <h4>Copy Writer</h4>
            </div>
          </div>

          <div class="profession-card card-5 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="1.0s">
            <div class="card-content">
              <img src="assets/images/img-5.png" alt="Machine Operator">
              <h4>Machine Operator</h4>
            </div>
          </div>

          <div class="profession-card card-6 wow zoomIn" data-wow-duration="0.5s" data-wow-delay="1.2s">
            <div class="card-content">
              <img src="assets/images/img-6.png" alt="Professional Chef">
              <h4>Professional Chef</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

        <!-- Features Grid -->
        <section class="vacanciewrp">
            <div class="container">
                <div class="section-title">
                    <h2 class="wow animate-slide-up" data-wow-duration="1s">The #1 Trusted <span>Dating Platform</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s">
                            <img src="assets/images/review.svg" alt="Community">
                            <h4>Awesome Community</h4>
                            <p>Join millions of authentic singles looking for real connections and meaningful relationships.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.1s">
                            <img src="assets/images/network.svg" alt="Members">
                            <h4>10M+ Members</h4>
                            <p>Connect with a diverse, global community of like-minded individuals seeking lasting love.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.2s">
                            <img src="assets/images/laptop.svg" alt="Groups">
                            <h4>Private Groups</h4>
                            <p>Join exclusive communities based on your interests, hobbies, and relationship goals.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.3s">
                            <img src="assets/images/chat.svg" alt="Forums">
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
        <section class="testiwrp">
            <div class="container">
                <div class="section-title">
                    <h2 class="text-white">What They're <span>Saying</span></h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s">
                            <img src="assets/images/testi-1.png" alt="Elton J. Dennie">
                            <p>"I never thought I'd find someone who truly understands me. The Love Project's matching algorithm is incredible - it connected me with my soulmate in just weeks!"</p>
                            <h5>Elton J. Dennie</h5>
                            <span>Happy Member</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.2s">
                            <img src="assets/images/testi-2.png" alt="Sarah J. Parker">
                            <p>"The 52-week journey transformed how I approach relationships. The weekly lessons and quizzes helped me understand myself and what I truly want in a partner."</p>
                            <h5>Sarah J. Parker</h5>
                            <span>Premium Member</span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="testimonial-card wow animate-zoom" data-wow-duration="0.5s" data-wow-delay="0.4s">
                            <img src="assets/images/testi-3.png" alt="Michael R. Smith">
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
                            <img src="assets/images/222.webp" alt="52 Weekly Lessons">
                            <div class="package-content">
                                <h3>52 Weekly Lessons</h3>
                                <p>Short, practical self-development lessons to help you grow emotionally and communicate better in relationships.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.2s">
                            <img src="assets/images/23232.webp" alt="Deep Personality Matches">
                            <div class="package-content">
                                <h3>Deep Personality Matches</h3>
                                <p>Matches based on values, emotional intelligence, and long-term compatibility - not just appearance or superficial interests.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.4s">
                            <img src="assets/images/istockphoto-1338846887-170667a.jpg" alt="Safe & Private Chat">
                            <div class="package-content">
                                <h3>Safe & Private Chat</h3>
                                <p>Double-moderated environment with AI protection and human moderation to keep your experience positive and secure.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="package-card wow animate-zoom" data-wow-duration="1s" data-wow-delay="0.6s">
                            <img src="assets/images/r2-.jpg" alt="Quality Over Quantity">
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
        <footer class="footer-section">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-4">
                        <div class="footer-widget">
                            <div class="footer-logo">
                                <img src="assets/images/love_logo.png" alt="The Love Project" class="img-fluid">
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
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">How It Works</a></li>
                                <li><a href="#">Success Stories</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-widget">
                            <h4>Services</h4>
                            <ul>
                                <li><a href="#">Logo Design</a></li>
                                <li><a href="#">Web Development</a></li>
                                <li><a href="#">SEO Services</a></li>
                                <li><a href="#">Mobile Apps</a></li>
                                <li><a href="#">Video Animation</a></li>
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
                        <p class="mb-0">© 2018-2025 The Love Project. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <ul>
                            <li><a href="#">Terms</a></li>
                            <li><a href="#">Privacy</a></li>
                            <li><a href="#">Cookies</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/mlib.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/canvas.js"></script>
    
    <script>
        // Page Loader
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('page-loader').classList.add('hide');
            }, 800);
        });

        // Header Scroll Effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });

        // Smooth Scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
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

        // Active nav link on scroll
        const sections = document.querySelectorAll('section[id]');
        
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                const sectionHeight = section.clientHeight;
                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
    
</body>
</html>