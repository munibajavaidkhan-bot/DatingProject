<!doctype html>
<html lang="en">
<head>
    <title>Law Enforcement Guidelines - The Love Project</title>
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
        
        .section-block { margin-bottom: 28px; scroll-margin-top: 100px; }
        .section-block h2 {
            border-bottom: 1px solid #eaeaea; padding-bottom: 12px; margin-bottom: 18px;
            font-size: 32px; color: #111; display: flex; align-items: center; gap: 15px;
        }
        .section-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 48px; height: 40px; background: #fff0f3; color: #e33054; 
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
            <h1>Law Enforcement Guidelines</h1>
            <p class="lead">How The Love Project responds to requests from law enforcement and government authorities</p>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input x-model="searchQuery" @input="handleSearch" type="text" placeholder="Search guidelines...">
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
                        <span class="text-dark fw-bold">Law Enforcement Guidelines</span>
                    </div>

                    <div x-show="searchQuery !== '' && matchCount > 0" x-cloak class="alert alert-danger px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-check-circle me-2"></i> Found <strong x-text="matchCount"></strong> matching sections.
                    </div>
                    <div x-show="searchQuery !== '' && matchCount === 0" x-cloak class="alert alert-secondary px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-info-circle me-2"></i> No matching sections found.
                    </div>

                    <div class="doc-card" id="document-content">
                        
                        <section id="section-1" class="section-block" data-title="1. About These Guidelines">
                            <h2><span class="section-number">1</span> About These Guidelines</h2>
                            <p>The Love Project (the "Platform") is operated by The Love Project. These guidelines are for law enforcement officers and government authorities seeking user information. They are not intended for users or members of the public; users should contact <a href="mailto:safety@luv54.com" class="text-danger fw-bold text-decoration-none">safety@luv54.com</a>.</p>
                            <p>We cooperate with law enforcement while protecting the privacy of our users. We disclose user data only in response to valid legal process, or voluntarily in genuine emergencies, as described below.</p>
                        </section>

                        <section id="section-2" class="section-block" data-title="2. Contact Points">
                            <h2><span class="section-number">2</span> Contact Points</h2>
                            <ul>
                                <li><strong>Non-emergency requests and legal process:</strong> <a href="mailto:lawenforcement@luv54.com" class="text-danger fw-bold text-decoration-none">lawenforcement@luv54.com</a> – reviewed within <strong>2</strong> business days.</li>
                                <li><strong>Emergency requests (24/7):</strong> <a href="mailto:emergency@luv54.com" class="text-danger fw-bold text-decoration-none">emergency@luv54.com</a> with "EMERGENCY" in the subject line, and phone [EMERGENCY PHONE NUMBER] – reviewed within <strong>1</strong> hour.</li>
                                <li><strong>Postal service of legal process:</strong> The Love Project, Attn: Legal / Law Enforcement Response, [REGISTERED ADDRESS].</li>
                            </ul>
                            <div class="alert-box">
                                <h5><i class="fas fa-exclamation-triangle mt-1"></i> Official Domains Only</h5>
                                <p class="mb-0">We accept requests only from official government or law enforcement email domains. Requests from personal email accounts will not be processed.</p>
                            </div>
                        </section>

                        <section id="section-3" class="section-block" data-title="3. What to Include">
                            <h2><span class="section-number">3</span> What to Include in a Request</h2>
                            <p>To help us process your request quickly, please include:</p>
                            <ul>
                                <li>the name of the requesting agency, and the officer's name, badge or ID number, official email address and direct phone number;</li>
                                <li>the legal process (subpoena, court order, search warrant or equivalent), signed and on official letterhead, as an attachment (PDF);</li>
                                <li>the account identifiers: the registered email address, username or profile URL (e.g. https://luv54.com/profile/…);</li>
                                <li>the specific information requested and the relevant date range;</li>
                                <li>a response deadline, and whether a non-disclosure order applies.</li>
                            </ul>
                            <p>Requests that are overly broad or unclear may be returned for clarification.</p>
                        </section>

                        <section id="section-4" class="section-block" data-title="4. Legal Process Required">
                            <h2><span class="section-number">4</span> Legal Process Required</h2>
                            <p>For requests from United States authorities, we follow the Stored Communications Act (18 U.S.C. §§ 2701–2713):</p>
                            <ul>
                                <li><strong>Basic account information</strong> (name, email address, sign-up date, IP address at sign-up and login, subscription and payment history, excluding full card numbers) – requires a valid subpoena, court order or search warrant.</li>
                                <li><strong>Other non-content records</strong> (e.g. login history, IP logs, account activity logs) – requires a court order under 18 U.S.C. § 2703(d) or a search warrant.</li>
                                <li><strong>Content</strong> (private messages, community posts, journal entries, profile photos) – requires a search warrant issued under procedures described in the Federal Rules of Criminal Procedure or equivalent state warrant procedures.</li>
                            </ul>
                            <div class="alert-box yellow">
                                <h5><i class="fas fa-globe"></i> Requests from Outside the United States</h5>
                                <p class="mb-0 text-dark">Requests from non-US authorities should normally be made through a Mutual Legal Assistance Treaty (MLAT) request or letters rogatory. In emergencies (Section 5) we may respond directly where the law permits.</p>
                            </div>
                        </section>

                        <section id="section-5" class="section-block" data-title="5. Emergency Disclosure">
                            <h2><span class="section-number">5</span> Emergency Disclosure Requests</h2>
                            <p>Where we believe in good faith that an emergency involving danger of death or serious physical injury to any person requires disclosure without delay, we may disclose information voluntarily, as permitted by 18 U.S.C. § 2702(b)(8) and § 2702(c)(4). This includes situations involving suspected human trafficking, the exploitation of a child, threats of violence, or a risk of suicide.</p>
                            <p>To make an emergency request, email <a href="mailto:emergency@luv54.com" class="text-danger fw-bold text-decoration-none">emergency@luv54.com</a> with "EMERGENCY" in the subject line and/or call [EMERGENCY PHONE NUMBER], and include:</p>
                            <ul>
                                <li>the nature of the emergency and the person(s) at risk;</li>
                                <li>why the danger is imminent and why normal legal process would be too slow;</li>
                                <li>the account identifiers and the specific information needed to address the emergency;</li>
                                <li>the requesting officer's name, agency, badge number and a callback number.</li>
                            </ul>
                            <p>We may call the requesting agency back through a publicly listed number to verify the request. Emergency requests must still be followed by appropriate legal process where required.</p>
                        </section>

                        <section id="section-6" class="section-block" data-title="6. Preservation Requests">
                            <h2><span class="section-number">6</span> Preservation Requests</h2>
                            <p>On receipt of a preservation request under 18 U.S.C. § 2703(f) or equivalent, we will preserve a one-time snapshot of the specified account data for 90 days while formal legal process is obtained. One 90-day extension may be requested. Please send preservation requests to <a href="mailto:lawenforcement@luv54.com" class="text-danger fw-bold text-decoration-none">lawenforcement@luv54.com</a> with the account identifiers and date range.</p>
                        </section>

                        <section id="section-7" class="section-block" data-title="7. Proactive Reporting">
                            <h2><span class="section-number">7</span> Proactive Reporting</h2>
                            <ul>
                                <li>We report apparent child sexual abuse material and child sexual exploitation to the NCMEC CyberTipline, as required by 18 U.S.C. § 2258A, and preserve the related data as required by law.</li>
                                <li>Where we identify suspected human trafficking, sexual exploitation, sexual violence, non-consensual intimate content or credible threats of violence, we suspend the accounts involved, preserve evidence, and may refer the matter to the relevant law enforcement authority.</li>
                            </ul>
                        </section>

                        <section id="section-8" class="section-block" data-title="8. Data Available & Retention">
                            <h2><span class="section-number">8</span> Data Available &amp; Retention</h2>
                            <p>Information we may hold includes: account registration details (name, email, date of birth), profile information, IP addresses and login records, community posts, private messages, journal entries, and subscription records. Payment card details are processed by our payment provider, Stripe, and are not stored by us. Data is retained as described in our <a href="{{ route('privacy') }}" class="text-danger fw-bold text-decoration-none">Privacy Policy</a>; deleted data may no longer be available.</p>
                        </section>

                        <section id="section-9" class="section-block" data-title="9. User Notification">
                            <h2><span class="section-number">9</span> User Notification</h2>
                            <p>Our policy is to notify users of requests for their data before disclosure, unless we are prohibited by law or court order (e.g. a non-disclosure order under 18 U.S.C. § 2705(b)), or notice would create a risk of harm to a person, including a child or victim, or would be counterproductive in an emergency.</p>
                        </section>

                        <section id="section-10" class="section-block" data-title="10. Internal Handling Process">
                            <h2><span class="section-number">10</span> Internal Handling Process</h2>
                            <ul>
                                <li><strong>Receive and log:</strong> every request is logged with date, time, agency and reference number.</li>
                                <li><strong>Verify:</strong> we confirm the requester's identity and that the request comes from an official domain or verified phone number.</li>
                                <li><strong>Review:</strong> we check the legal basis, scope and account identifiers. Emergency requests are reviewed immediately.</li>
                                <li><strong>Preserve:</strong> relevant data is preserved as soon as a valid request is received.</li>
                                <li><strong>Respond:</strong> we disclose only the data covered by the request, securely, and record what was disclosed and when.</li>
                                <li><strong>Follow up:</strong> where appropriate, we notify the user (Section 9) and take action on the account under our <a href="{{ route('terms') }}" class="text-danger fw-bold text-decoration-none">Terms</a> and <a href="{{ route('acceptable.use') }}" class="text-danger fw-bold text-decoration-none">Acceptable Use Policy</a>.</li>
                            </ul>
                        </section>

                    </div>
                    
                    <div class="text-center mt-5 no-print">
                        <h3 class="font-playfair fw-bold mb-3">Need to Contact Us?</h3>
                        <p class="text-muted mb-4">For user support, please contact <a href="mailto:safety@luv54.com" class="text-danger fw-bold text-decoration-none">safety@luv54.com</a>. Law enforcement requests should be sent to the contact points above.</p>
                        <a href="{{ route('privacy') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Read Our Privacy Policy</a>
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
