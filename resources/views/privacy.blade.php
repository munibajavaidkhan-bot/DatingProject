<!doctype html>
<html lang="en">
<head>
    <title>Privacy Policy - The Love Project</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
    
    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS (Matching main site) -->
    <link href="/assets/css/m-style.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/newcss.css" rel="stylesheet">
    <link href="/assets/css/site-header-footer.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
        
        /* Inner page hero */
        .inner-header {
            padding: 80px 0 80px;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            color: white;
            text-align: center;
        }
        .inner-header h1 { color: white; font-weight: 800; font-size: 3.5rem; margin-bottom: 20px;}
        
        .search-box { position: relative; max-width: 500px; margin: 30px auto 0; }
        .search-box i { position: absolute; left: 20px; top: 16px; color: #a1a1aa; font-size: 18px;}
        .search-box input { 
            width: 100%; border-radius: 30px; height: 50px; border: none; 
            padding-left: 50px; padding-right: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
            font-size: 16px; outline: none;
        }
        
        .page-content-wrapper { padding: 60px 0; }
        
        .toc-card {
            background: #fff; border-radius: 16px; border: 1px solid #eaeaea; 
            padding: 24px; position: sticky; top: 100px; box-shadow: 0 5px 20px rgba(0,0,0,0.02);
        }
        .toc-card h5 { font-family: 'Inter', sans-serif; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 15px; color: #777;}
        .toc-link {
            display: block; padding: 10px 15px; color: #555; text-decoration: none; 
            font-size: 14px; border-radius: 8px; margin-bottom: 4px; transition: all 0.2s;
        }
        .toc-link:hover, .toc-link.active { background: #fdf4ff; color: #a855f7; font-weight: 600; }
        
        .doc-card {
            background: #fff; border-radius: 16px; border: 1px solid #eaeaea; 
            padding: 50px; box-shadow: 0 5px 30px rgba(0,0,0,0.03);
        }
        
        .breadcrumb-custom {
            display: flex; gap: 10px; align-items: center; font-size: 14px; color: #6c757d; margin-bottom: 30px;
        }
        .breadcrumb-custom a { color: #a855f7; text-decoration: none; font-weight: 500;}
        
        .section-block { margin-bottom: 50px; scroll-margin-top: 100px; }
        .section-block h2 {
            border-bottom: 1px solid #eaeaea; padding-bottom: 15px; margin-bottom: 25px; 
            font-size: 32px; color: #111; display: flex; align-items: center; gap: 15px;
        }
        .section-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; background: #fdf4ff; color: #a855f7; 
            border-radius: 10px; font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 700;
        }
        .section-block p, .section-block li { font-size: 16px; line-height: 1.8; color: #555; }
        .section-block ul { margin-left: 15px; }
        .section-block li { margin-bottom: 10px; }
        
        .alert-box {
            background: #fdf4ff; border-left: 4px solid #a855f7; 
            padding: 20px; border-radius: 0 10px 10px 0; margin: 25px 0;
        }
        .alert-box.green { background: #f0fdf4; border-color: #22c55e; }
        .alert-box.red { background: #fef2f2; border-color: #ef4444; }
        .alert-box h5 { margin-bottom: 10px; font-family: 'Inter', sans-serif; font-weight: 700;}
        .alert-box.green h5 { color: #166534; }
        .alert-box.red h5 { color: #991b1b; }
        .alert-box:not(.green):not(.red) h5 { color: #7e22ce; }
        
        .print-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%;
            background: #fff; border: 1px solid #ddd; padding: 12px; border-radius: 10px;
            color: #444; font-weight: 600; text-decoration: none; margin-top: 20px; transition: 0.2s;
        }
        .print-btn:hover { background: #f8f9fa; border-color: #ccc; color: #a855f7; }
        
        [x-cloak] { display: none !important; }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .doc-card { border: none; box-shadow: none; padding: 0; }
            .section-block { page-break-inside: avoid; }
        }
    </style>
</head>
<body x-data="documentController()">

    <!-- Navigation (shared) -->
    <div class="no-print">
        @include('partials.site-header', ['active' => 'home'])
    </div>

    <!-- Header Vector -->
    <div class="inner-header no-print">
        <div class="container">
            <span class="badge bg-white text-purple px-3 py-2 rounded-pill mb-3 shadow-sm" style="color:#a855f7;">Updated: March 12, 2026</span>
            <h1>Privacy Policy</h1>
            <p class="lead">How The Love Project protects and uses your data.</p>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input x-model="searchQuery" @input="handleSearch" type="text" placeholder="Search privacy rules...">
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="page-content-wrapper">
        <div class="container">
            <div class="row gx-5">
                
                <!-- Sidebar -->
                <div class="col-lg-3 d-none d-lg-block no-print">
                    <div class="toc-card">
                        <h5><i class="fas fa-list-ul me-2 text-purple" style="color:#a855f7;"></i> Contents</h5>
                        <div class="d-flex flex-column gap-1">
                            <template x-for="(section, index) in sections" :key="section.id">
                                <a @click.prevent="scrollTo(section.id)" :href="'#' + section.id" class="toc-link" :class="activeSection === section.id ? 'active' : ''" x-text="section.title"></a>
                            </template>
                        </div>
                        
                        <div class="mt-4 pt-3 border-top">
                            <button @click="window.print()" class="print-btn">
                                <i class="fas fa-print"></i> Print PDF Free
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Main Doc -->
                <div class="col-lg-9">
                    
                    <div class="breadcrumb-custom no-print">
                        <a href="/"><i class="fas fa-home me-1"></i> Home</a> 
                        <i class="fas fa-chevron-right" style="font-size:10px;"></i> 
                        <span>Legal</span>
                        <i class="fas fa-chevron-right" style="font-size:10px;"></i>
                        <span class="text-dark fw-bold">Privacy Policy</span>
                    </div>

                    <div x-show="searchQuery !== '' && matchCount > 0" x-cloak class="alert alert-info px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-check-circle me-2"></i> Found <strong x-text="matchCount"></strong> matching sections.
                    </div>
                    <div x-show="searchQuery !== '' && matchCount === 0" x-cloak class="alert alert-secondary px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-info-circle me-2"></i> No matches found for "<span x-text="searchQuery" class="fw-bold"></span>".
                    </div>

                    <div class="doc-card" id="document-content">
                        
                        <div class="alert-box green mb-5">
                            <h5><i class="fas fa-info-circle mt-1"></i> Your Privacy comes first</h5>
                            <p class="mb-0 text-dark">This Privacy Policy explains how The Love Project collects, uses, and protects your information when you use our Platform.</p>
                        </div>

                        <section id="section-1" class="section-block" data-title="1. Information We Collect">
                            <h2><span class="section-number">1</span> Information We Collect</h2>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-4">
                                    <h5 class="fw-bold"><i class="fas fa-user-edit text-primary me-2"></i> User-Provided</h5>
                                    <ul class="text-muted mt-3">
                                        <li>Name & email</li>
                                        <li>Profile information</li>
                                        <li>Chat & community posts</li>
                                        <li>Journal entries</li>
                                        <li>Payment data</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h5 class="fw-bold"><i class="fas fa-laptop-code text-info me-2"></i> Auto-Collected</h5>
                                    <ul class="text-muted mt-3">
                                        <li>IP address</li>
                                        <li>Device & browser data</li>
                                        <li>Platform usage analytics</li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <section id="section-2" class="section-block" data-title="2. How We Use Information">
                            <h2><span class="section-number">2</span> How We Use Information</h2>
                            <p>We use your information to operate chat and community features, maintain platform safety, improve content, communicate updates, and process payments.</p>
                            <div class="alert-box green mt-3">
                                <h5><i class="fas fa-shield-check"></i> We never sell your data</h5>
                                <p class="mb-0">Your personal data is strictly confidential and not sold to any third parties under any circumstances.</p>
                            </div>
                        </section>

                        <section id="section-3" class="section-block" data-title="3. Chat & Community">
                            <h2><span class="section-number">3</span> Chat & Community Data</h2>
                            <p>Messages are stored to enable platform functionality. We do not review messages unless required for safety or legal reasons.</p>
                            <div class="alert-box yellow" style="background:#fffaf0; border-color:#eab308; border-left:4px solid #eab308; padding:20px;">
                                <h5 style="color:#ca8a04;"><i class="fas fa-exclamation-triangle"></i> Safety Tip</h5>
                                <p class="mb-0 text-dark">Never share passwords, financial details, or personal identification numbers in messages or public posts.</p>
                            </div>
                        </section>

                        <section id="section-4" class="section-block" data-title="4. Cookies">
                            <h2><span class="section-number">4</span> Cookies</h2>
                            <p>Cookies are used to maintain login sessions, improve performance, and analyze usage trends. Users can manage cookies via their browser settings easily.</p>
                        </section>

                        <section id="section-5" class="section-block" data-title="5. CCPA/CPRA">
                            <h2><span class="section-number">5</span> California Privacy Rights</h2>
                            <p>California residents may request data access, data deletion, and disclosure of data usage. Contact us via email to request this.</p>
                        </section>

                        <section id="section-6" class="section-block" data-title="6. Data Security">
                            <h2><span class="section-number">6</span> Data Security</h2>
                            <p>We use reasonable security measures to protect your information. However, no system is completely secure. Users accept the inherent risk of any online platform.</p>
                        </section>

                        <section id="section-7" class="section-block" data-title="7. Data Retention">
                            <h2><span class="section-number">7</span> Data Retention</h2>
                            <p>Data is retained only as long as needed to provide services or required by law. After account deletion, some data may be retained for limited backup or compliance.</p>
                        </section>

                        <section id="section-8" class="section-block" data-title="8. Children's Privacy">
                            <h2><span class="section-number">8</span> Children's Privacy</h2>
                            <div class="alert-box red">
                                <h5><i class="fas fa-ban mt-1"></i> Age Restrictions</h5>
                                <p class="mb-0">The Platform is <strong>not intended for users under 18</strong>. We do not knowingly collect information from minors.</p>
                            </div>
                        </section>

                        <section id="section-9" class="section-block" data-title="9. Policy Updates">
                            <h2><span class="section-number">9</span> Policy Updates</h2>
                            <p>Changes to this Privacy Policy will be posted with an updated effective date. Continued use constitutes acceptance. We will notify users of major changes via email.</p>
                        </section>

                        <section id="section-10" class="section-block" data-title="10. Contact Us">
                            <h2><span class="section-number">10</span> Contact Us</h2>
                            <p>If you have any questions about this Privacy Policy, your data, or our practices, please contact us!</p>
                            <div class="row mt-4">
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                        <i class="fas fa-shield-alt" style="color:#a855f7; font-size:24px;"></i>
                                        <div>
                                            <h6 class="mb-1 fw-bold">Privacy Inquiries</h6>
                                            <a href="mailto:Tatiana@theloveproject.us" class="text-decoration-none fw-bold" style="color:#a855f7;">Tatiana@theloveproject.us</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                        <i class="fas fa-envelope text-primary" style="font-size:24px;"></i>
                                        <div>
                                            <h6 class="mb-1 fw-bold">General Support</h6>
                                            <a href="mailto:Support@loveproject.us" class="text-decoration-none text-primary fw-bold">Support@loveproject.us</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                    
                    <!-- Footer CTA directly in content -->
                    <div class="text-center mt-5 no-print">
                        <h3 class="font-playfair fw-bold mb-3">Your Privacy is Protected</h3>
                        <p class="text-muted mb-4">We're committed to giving you complete control over your data.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill" style="background:#a855f7; border-color:#a855f7;">Get Started Today</a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (shared) -->
    <div class="no-print">
        @include('partials.site-footer', ['active' => 'home'])
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function documentController() {
            return {
                searchQuery: '',
                activeSection: 'section-1',
                sections: [],
                matchCount: 0,

                init() {
                    const sectionEls = document.querySelectorAll('.section-block');
                    sectionEls.forEach(el => {
                        this.sections.push({
                            id: el.id,
                            title: el.getAttribute('data-title'),
                            text: el.innerText.toLowerCase()
                        });
                    });

                    const observer = new IntersectionObserver((entries) => {
                        let activeFound = false;
                        entries.forEach(entry => {
                            if (entry.isIntersecting && !activeFound) {
                                this.activeSection = entry.target.id;
                                activeFound = true;
                            }
                        });
                    }, { rootMargin: '-100px 0px -60% 0px' });

                    sectionEls.forEach(el => observer.observe(el));
                },

                scrollTo(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth' });
                        this.activeSection = id;
                    }
                },

                handleSearch() {
                    const query = this.searchQuery.toLowerCase().trim();
                    this.matchCount = 0;

                    if (!query) {
                        document.querySelectorAll('.section-block').forEach(el => el.style.display = 'block');
                        return;
                    }

                    document.querySelectorAll('.section-block').forEach((el, index) => {
                        const text = el.innerText.toLowerCase();
                        if (text.includes(query)) {
                            el.style.display = 'block';
                            this.matchCount++;
                        } else {
                            el.style.display = 'none';
                        }
                    });
                }
            }
        }
    </script>
</body>
</html>
