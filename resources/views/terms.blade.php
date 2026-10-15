<!doctype html>
<html lang="en">
<head>
    <title>Terms & Conditions - The Love Project</title>
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
        
        .inner-header {
            padding: 80px 0 80px;
            background: linear-gradient(135deg, #e33054 0%, #ff5277 100%);
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
        .toc-link:hover, .toc-link.active { background: #fff0f3; color: #e33054; font-weight: 600; }
        
        .doc-card {
            background: #fff; border-radius: 16px; border: 1px solid #eaeaea; 
            padding: 50px; box-shadow: 0 5px 30px rgba(0,0,0,0.03);
        }
        
        .breadcrumb-custom {
            display: flex; gap: 10px; align-items: center; font-size: 14px; color: #6c757d; margin-bottom: 30px;
        }
        .breadcrumb-custom a { color: #e33054; text-decoration: none; font-weight: 500;}
        
        .section-block { margin-bottom: 50px; scroll-margin-top: 100px; }
        .section-block h2 {
            border-bottom: 1px solid #eaeaea; padding-bottom: 15px; margin-bottom: 25px; 
            font-size: 32px; color: #111; display: flex; align-items: center; gap: 15px;
        }
        .section-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 40px; height: 40px; background: #fff0f3; color: #e33054; 
            border-radius: 10px; font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 700;
        }
        .section-block p, .section-block li { font-size: 16px; line-height: 1.8; color: #555; }
        .section-block ul { margin-left: 15px; }
        .section-block li { margin-bottom: 10px; }
        
        .alert-box {
            background: #fff0f3; border-left: 4px solid #e33054; 
            padding: 20px; border-radius: 0 10px 10px 0; margin: 25px 0;
        }
        .alert-box.yellow { background: #fffdf0; border-color: #f59e0b; }
        .alert-box h5 { margin-bottom: 10px; font-family: 'Inter', sans-serif; font-weight: 700;}
        .alert-box.yellow h5 { color: #b45309; }
        .alert-box:not(.yellow) h5 { color: #be123c; }
        
        .print-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%;
            background: #fff; border: 1px solid #ddd; padding: 12px; border-radius: 10px;
            color: #444; font-weight: 600; text-decoration: none; margin-top: 20px; transition: 0.2s;
        }
        .print-btn:hover { background: #f8f9fa; border-color: #ccc; color: #e33054; }
        
        [x-cloak] { display: none !important; }

        @media print {
            .no-print, .site-header { display: none !important; }
            body { background: white; }
            .doc-card { border: none; box-shadow: none; padding: 0; }
            .section-block { page-break-inside: avoid; }
        }
    </style>
</head>
<body x-data="documentController()">

    <!-- Navigation (shared) -->
    @include('partials.site-header', ['active' => 'home'])

    <!-- Header Vector -->
    <div class="inner-header no-print">
        <div class="container">
            <span class="badge bg-white text-danger px-3 py-2 rounded-pill mb-3 shadow-sm">Updated: October 15, 2026</span>
            <h1>Terms & Conditions</h1>
            <p class="lead">The Love Project – 52-Week Dating Journey</p>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input x-model="searchQuery" @input="handleSearch" type="text" placeholder="Search terms & rules...">
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
                        <h5><i class="fas fa-list-ul me-2 text-danger"></i> Contents</h5>
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
                        <span class="text-dark fw-bold">Terms & Conditions</span>
                    </div>

                    <div x-show="searchQuery !== '' && matchCount > 0" x-cloak class="alert alert-danger px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-check-circle me-2"></i> Found <strong x-text="matchCount"></strong> matching sections.
                    </div>
                    <div x-show="searchQuery !== '' && matchCount === 0" x-cloak class="alert alert-secondary px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-info-circle me-2"></i> No matches found for "<span x-text="searchQuery" class="fw-bold"></span>".
                    </div>

                    <div class="doc-card" id="document-content">
                        
                        <section id="section-1" class="section-block" data-title="1. Platform Purpose">
                            <h2><span class="section-number">1</span> Platform Purpose</h2>
                            <p>The Love Project is a guided dating and personal-growth platform offering structured weekly prompts, reflective exercises, community discussion spaces, and optional private messaging.</p>
                            <div class="alert-box">
                                <h5><i class="fas fa-exclamation-triangle mt-1"></i> Important Note</h5>
                                <p class="mb-0">The Platform is <strong>not</strong> a dating agency, matchmaking service, or relationship guarantee provider.</p>
                            </div>
                        </section>

                        <section id="section-2" class="section-block" data-title="2. Eligibility & Age Verification">
                            <h2><span class="section-number">2</span> Eligibility &amp; Age Verification</h2>
                            <ul>
                                <li><strong>Age requirement:</strong> You must be at least 18 years old to create an account or use the Platform. Use by anyone under 18 is strictly prohibited.</li>
                                <li><strong>Age check at sign-up:</strong> Every user must enter their date of birth and confirm they are 18 or older when registering. Registration is automatically refused if the date of birth shows the person is under 18.</li>
                                <li><strong>Accounts belonging to minors:</strong> If we learn or reasonably suspect that an account belongs to someone under 18, we will suspend it immediately, delete it, and, where content suggests a child may be at risk, report it to the appropriate authorities (see Section 4A).</li>
                                <li><strong>False information:</strong> Giving a false date of birth or false identity information is a serious breach of these Terms and will result in permanent removal.</li>
                                <li><strong>Legal capacity:</strong> By using the Platform you confirm you have the legal capacity to enter into a binding agreement.</li>
                            </ul>
                        </section>

                        <section id="section-3" class="section-block" data-title="3. Community Disclaimer">
                            <h2><span class="section-number">3</span> Community & Social Disclaimer</h2>
                            <div class="alert-box yellow">
                                <h5><i class="fas fa-shield-alt"></i> Very Important Notice</h5>
                                <p class="mb-0 text-dark">The Platform includes community discussion areas ("Social Corner") and optional user-to-user messaging. We do not monitor, verify, or moderate all communications in real time.</p>
                            </div>
                            <ul class="mt-3">
                                <li>Conversations are user-generated.</li>
                                <li>Interactions occur at your own discretion and risk.</li>
                                <li>We are not responsible for user conduct, statements, or offline interactions.</li>
                            </ul>
                        </section>

                        <section id="section-4" class="section-block" data-title="4. Prohibited Conduct">
                            <h2><span class="section-number">4</span> Prohibited Conduct</h2>
                            <p>Your use of the Platform is also governed by our <a href="{{ route('acceptable.use') }}" class="text-danger fw-bold text-decoration-none">Acceptable Use Policy</a>, which forms part of these Terms. You must not use the Platform, its community areas or its messaging features to:</p>
                            <ul>
                                <li>Engage in or facilitate human trafficking, including sexual exploitation, forced labour, or recruiting, transporting, harbouring or advertising any person for exploitation.</li>
                                <li>Buy, sell, offer or solicit sexual services, escorting, or companionship in exchange for money, gifts or other benefit.</li>
                                <li>Commit, threaten, promote, glorify or depict sexual violence, including rape, sexual assault, sexual coercion or sextortion.</li>
                                <li>Share, threaten to share or request non-consensual content, including intimate or sexual images or videos of anyone without their consent, secretly recorded material, and fake or AI-generated sexual images of a real person.</li>
                                <li>Aid, abet, encourage or incite abuse of any kind, including physical, sexual, emotional, financial or domestic abuse, or coercive control, or help anyone carry out such abuse.</li>
                                <li>Sexualise, groom or exploit minors, or share any content that sexualises anyone under 18.</li>
                                <li>Harass, threaten, stalk, shame, intimidate or manipulate others.</li>
                                <li>Share explicit sexual content.</li>
                                <li>Promote hate, discrimination, violence or abusive behaviour.</li>
                                <li>Share anyone's private contact details or personal information without their consent.</li>
                                <li>Engage in scams, romance fraud, impersonation or requests for money.</li>
                                <li>Pressure others into emotional, sexual or romantic decisions.</li>
                            </ul>
                        </section>

                        <section id="section-4a" class="section-block" data-title="4A. Zero Tolerance">
                            <h2><span class="section-number">4A</span> Zero Tolerance: Trafficking, Sexual Exploitation, Sexual Violence &amp; Child Safety</h2>
                            <p>The Love Project has a zero-tolerance policy for human trafficking, sexual exploitation, sexual violence, non-consensual content, the abuse of any person, and any content involving the sexual exploitation of minors. If we find this type of activity or content, we will:</p>
                            <ul>
                                <li>remove the content and permanently ban the accounts involved, without warning or refund;</li>
                                <li>preserve relevant account data and records as evidence;</li>
                                <li>report suspected child sexual exploitation material to the National Center for Missing &amp; Exploited Children (NCMEC) CyberTipline, as required by law, and report suspected trafficking or other serious crimes to the relevant law enforcement authorities;</li>
                                <li>cooperate fully with law enforcement investigations, in line with our <a href="{{ route('law.enforcement') }}" class="text-danger fw-bold text-decoration-none">Law Enforcement Guidelines</a>.</li>
                            </ul>
                        </section>

                        <section id="section-4b" class="section-block" data-title="4B. Reporting & Enforcement">
                            <h2><span class="section-number">4B</span> Reporting &amp; Enforcement</h2>
                            <ul>
                                <li>Every profile, message and community post has a Report option. You can also block any user at any time.</li>
                                <li>You can email reports to <a href="mailto:safety@luv54.com" class="text-danger fw-bold text-decoration-none">safety@luv54.com</a>.</li>
                                <li>Reports involving trafficking, sexual violence, non-consensual content, threats or minors are prioritised and reviewed within <strong>24</strong> hours.</li>
                                <li>Depending on severity, we may remove content, issue a warning, restrict features, suspend, or permanently ban an account.</li>
                                <li>If anyone is in immediate danger, contact your local emergency services first (911 in the US, 112 or 999 in Ireland, the UK and the EU).</li>
                            </ul>
                        </section>

                        <section id="section-4c" class="section-block" data-title="4C. Law Enforcement Cooperation">
                            <h2><span class="section-number">4C</span> Cooperation with Law Enforcement</h2>
                            <p>We cooperate with law enforcement and may disclose account information where we are legally required to, or where we believe in good faith that disclosure is necessary to prevent death or serious physical harm, to protect a child, or to investigate trafficking, exploitation or other serious crime. Our process for handling requests is set out in our <a href="{{ route('law.enforcement') }}" class="text-danger fw-bold text-decoration-none">Law Enforcement Guidelines</a>.</p>
                        </section>

                        <section id="section-5" class="section-block" data-title="5. No Professional Advice">
                            <h2><span class="section-number">5</span> No Professional Advice</h2>
                            <p>Content is for educational, reflective, and personal development purposes only and does not replace:</p>
                            <ul>
                                <li>Therapy or Counseling</li>
                                <li>Psychological Diagnosis</li>
                                <li>Medical or Legal Advice</li>
                            </ul>
                        </section>

                        <section id="section-6" class="section-block" data-title="6. User Accounts">
                            <h2><span class="section-number">6</span> User Accounts & Responsibility</h2>
                            <p>You are responsible for your own content and interactions. You must maintain account confidentiality. We may suspend or terminate accounts for safety, legal, or policy reasons.</p>
                        </section>

                        <section id="section-7" class="section-block" data-title="7. User Content">
                            <h2><span class="section-number">7</span> User-Generated Content & Journaling</h2>
                            <ul>
                                <li>Users retain ownership of their personal content.</li>
                                <li>Private journals remain private unless intentionally shared.</li>
                                <li>By posting publicly, users grant the Platform a limited license to display content within the Platform only.</li>
                            </ul>
                        </section>

                        <section id="section-8" class="section-block" data-title="8. Paid Features">
                            <h2><span class="section-number">8</span> Paid Features & Subscriptions</h2>
                            <p>Some features require payment. Pricing and billing terms are disclosed before purchase. Subscriptions auto-renew unless cancelled. Refunds are governed by the stated Refund Policy.</p>
                        </section>

                        <section id="section-9" class="section-block" data-title="9. Safety & Offline">
                            <h2><span class="section-number">9</span> Safety & Offline Interactions</h2>
                            <p>We are not responsible for offline meetings, emotional outcomes, relationship decisions, or personal safety beyond the Platform. Users are strongly encouraged to exercise personal judgment and caution.</p>
                        </section>

                        <section id="section-10" class="section-block" data-title="10. Liability">
                            <h2><span class="section-number">10</span> Limitation of Liability</h2>
                            <p>To the fullest extent permitted by law, we are not liable for user communications, dating outcomes, emotional distress, or damages arising from Platform use.</p>
                        </section>

                        <section id="section-11" class="section-block" data-title="11. Termination">
                            <h2><span class="section-number">11</span> Termination</h2>
                            <p>We may terminate or restrict access for policy violations, to protect community safety, or for legal/operational reasons.</p>
                        </section>

                        <section id="section-12" class="section-block" data-title="12. Governing Law">
                            <h2><span class="section-number">12</span> Governing Law</h2>
                            <p>These Terms are governed by <strong>United States law</strong>.</p>
                        </section>

                        <section id="section-13" class="section-block" data-title="13. Contact Us">
                            <h2><span class="section-number">13</span> Contact</h2>
                            <div class="d-flex align-items-center gap-3 p-4 bg-light rounded-3 border">
                                <i class="fas fa-envelope text-danger fa-2x"></i>
                                <div>
                                    <h6 class="mb-1 fw-bold">Support Email</h6>
                                    <a href="mailto:Support@loveproject.us" class="text-decoration-none text-danger fw-bold fs-5">Support@loveproject.us</a>
                                </div>
                            </div>
                        </section>

                    </div>
                    
                    <div class="text-center mt-5 no-print">
                        <h3 class="font-playfair fw-bold mb-3">Ready to Start Your Journey?</h3>
                        <p class="text-muted mb-4">By using The Love Project, you agree to these terms.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Sign In to Continue</a>
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
