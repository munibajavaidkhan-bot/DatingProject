<!doctype html>
<html lang="en">
<head>
    <title>Acceptable Use Policy - The Love Project</title>
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
            <h1>Acceptable Use Policy</h1>
            <p class="lead">The Love Project – 52-Week Dating Journey</p>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input x-model="searchQuery" @input="handleSearch" type="text" placeholder="Search policy &amp; rules...">
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
                        <span class="text-dark fw-bold">Acceptable Use Policy</span>
                    </div>

                    <div x-show="searchQuery !== '' && matchCount > 0" x-cloak class="alert alert-danger px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-check-circle me-2"></i> Found <strong x-text="matchCount"></strong> matching sections.
                    </div>
                    <div x-show="searchQuery !== '' && matchCount === 0" x-cloak class="alert alert-secondary px-4 py-3 rounded-3 shadow-sm mb-4">
                        <i class="fas fa-info-circle me-2"></i> No matching sections found.
                    </div>

                    <div class="doc-card" id="document-content">
                        
                        <section id="section-1" class="section-block" data-title="1. Purpose & Scope">
                            <h2><span class="section-number">1</span> Purpose &amp; Scope</h2>
                            <p>This Acceptable Use Policy ("AUP") explains what is and is not allowed on The Love Project (the "Platform"), operated by The Love Project. It applies to every user, every profile, every community post in the Social Corner, every private message, and any content you upload or share. This AUP forms part of our <a href="{{ route('terms') }}" class="text-danger fw-bold text-decoration-none">Terms &amp; Conditions</a>. Breaking it can lead to removal of content, suspension or permanent banning, and reporting to law enforcement.</p>
                        </section>

                        <section id="section-2" class="section-block" data-title="2. Trafficking & Sexual Exploitation">
                            <h2><span class="section-number">2</span> Human Trafficking &amp; Sexual Exploitation (Zero Tolerance)</h2>
                            <p>You must not use the Platform to engage in, facilitate, advertise or support human trafficking or sexual exploitation in any form. This includes:</p>
                            <ul>
                                <li>recruiting, transporting, transferring, harbouring or receiving any person for sexual exploitation, forced labour, servitude or any other form of exploitation;</li>
                                <li>advertising, offering, buying or soliciting sexual services, escort services, or companionship in exchange for money, gifts, travel, accommodation or any other benefit (including "sugar" or "arrangement" style relationships);</li>
                                <li>using deception, threats, debt, force or control over someone's documents, money or movement to exploit them;</li>
                                <li>recruiting people with false offers of work, travel, marriage or relationships;</li>
                                <li>pimping, procuring or profiting from another person's sexual activity.</li>
                            </ul>
                        </section>

                        <section id="section-3" class="section-block" data-title="3. Child Safety">
                            <h2><span class="section-number">3</span> Child Safety (Zero Tolerance)</h2>
                            <div class="alert-box">
                                <h5><i class="fas fa-exclamation-triangle mt-1"></i> Adults Only</h5>
                                <p class="mb-0">The Platform is strictly for adults aged 18 and over.</p>
                            </div>
                            <ul>
                                <li>You must not create, share, request or link to any content that sexualises minors, including child sexual abuse material (CSAM), whether real, drawn or AI-generated.</li>
                                <li>You must not groom, contact for sexual purposes, or attempt to meet anyone under 18.</li>
                                <li>We report all apparent child sexual exploitation to the NCMEC CyberTipline and to law enforcement, and we preserve related evidence.</li>
                            </ul>
                        </section>

                        <section id="section-4" class="section-block" data-title="4. Sexual Violence">
                            <h2><span class="section-number">4</span> Sexual Violence</h2>
                            <p>You must not commit, threaten, promote, glorify, joke about approvingly, or depict sexual violence. This includes:</p>
                            <ul>
                                <li>content that depicts, describes approvingly or encourages rape, sexual assault or sexual coercion;</li>
                                <li>threats of sexual violence against anyone, on or off the Platform;</li>
                                <li>sextortion, meaning threatening to share someone's intimate images or information unless they provide money, images or sexual acts;</li>
                                <li>pressuring, manipulating or coercing anyone into sexual activity, sexual conversation or sharing images.</li>
                            </ul>
                            <div class="alert-box yellow">
                                <h5><i class="fas fa-shield-alt"></i> Allowed Exception</h5>
                                <p class="mb-0 text-dark">Discussion of personal experiences of sexual violence for the purpose of support, healing or awareness is allowed, provided it is not graphic and does not target or identify another user.</p>
                            </div>
                        </section>

                        <section id="section-5" class="section-block" data-title="5. Non-Consensual Content">
                            <h2><span class="section-number">5</span> Non-Consensual Content</h2>
                            <p>You must not share, threaten to share, request or trade content without the consent of the people in it. This includes:</p>
                            <ul>
                                <li>intimate, nude or sexual images or videos of any person shared without their consent (so-called "revenge porn");</li>
                                <li>images, video or audio recorded secretly or without the knowledge of the person recorded;</li>
                                <li>fake, edited or AI-generated ("deepfake") sexual or intimate images of a real person;</li>
                                <li>private messages, screenshots or personal information (such as address, workplace or phone number) of another person shared to shame, expose, intimidate or harass them;</li>
                                <li>photos of another person used on your profile, or anyone else's identity used as your own.</li>
                            </ul>
                        </section>

                        <section id="section-6" class="section-block" data-title="6. Aiding Abuse">
                            <h2><span class="section-number">6</span> Aiding, Abetting or Encouraging Abuse</h2>
                            <p>You must not commit abuse, or aid, abet, encourage, incite, or help anyone else commit abuse. This includes:</p>
                            <ul>
                                <li>physical, sexual, emotional, psychological or financial abuse, domestic abuse and coercive control;</li>
                                <li>encouraging or giving advice on how to control, isolate, track, monitor or intimidate a partner or any other person;</li>
                                <li>helping someone locate, stalk or contact a person who does not want to be contacted;</li>
                                <li>praising, justifying or celebrating abuse or abusers;</li>
                                <li>encouraging anyone to harm themselves.</li>
                            </ul>
                        </section>

                        <section id="section-7" class="section-block" data-title="7. Other Prohibited Conduct">
                            <h2><span class="section-number">7</span> Other Prohibited Conduct</h2>
                            <ul>
                                <li>Harassment, bullying, threats, stalking, shaming or intimidation.</li>
                                <li>Hate speech or discrimination based on race, ethnicity, nationality, religion, sex, gender identity, sexual orientation, disability or age.</li>
                                <li>Explicit sexual content or nudity.</li>
                                <li>Scams, romance fraud, phishing, requests for money, gifts, investments or financial details.</li>
                                <li>Impersonation, fake profiles, or creating an account for someone else.</li>
                                <li>Spam, commercial advertising or promotion without our written permission.</li>
                                <li>Any illegal activity, or content that promotes illegal activity.</li>
                            </ul>
                        </section>

                        <section id="section-8" class="section-block" data-title="8. How We Enforce">
                            <h2><span class="section-number">8</span> How We Enforce This Policy</h2>
                            <ul>
                                <li>We review content reported by users and may proactively review public content and flagged activity.</li>
                                <li>Actions we may take include content removal, warnings, feature restrictions, temporary suspension and permanent bans. Banned users may not create new accounts.</li>
                                <li>Breaches of Sections 2–6 result in an immediate permanent ban without refund.</li>
                                <li>We preserve evidence and refer suspected trafficking, child exploitation, sexual violence, non-consensual intimate content and threats of violence to law enforcement in line with our <a href="{{ route('law.enforcement') }}" class="text-danger fw-bold text-decoration-none">Law Enforcement Guidelines</a>.</li>
                            </ul>
                        </section>

                        <section id="section-9" class="section-block" data-title="9. How to Report">
                            <h2><span class="section-number">9</span> How to Report</h2>
                            <ul>
                                <li>Use the Report button on any profile, message or post, or block the user.</li>
                                <li>Email <a href="mailto:safety@luv54.com" class="text-danger fw-bold text-decoration-none">safety@luv54.com</a> with the username and a description (screenshots help).</li>
                                <li>Reports involving trafficking, minors, sexual violence, non-consensual content or threats are prioritised and reviewed within <strong>24</strong> hours.</li>
                                <li>If someone is in immediate danger, contact emergency services first (911 in the US; 112 or 999 in Ireland, the UK and the EU).</li>
                            </ul>
                            <div class="alert-box">
                                <h5><i class="fas fa-hands-helping mt-1"></i> Help and Support</h5>
                                <ul class="mb-0">
                                    <li><strong>US National Human Trafficking Hotline:</strong> 1-888-373-7888 (text 233733)</li>
                                    <li><strong>NCMEC CyberTipline (child sexual exploitation):</strong> report.cybertip.org or 1-800-843-5678</li>
                                    <li><strong>RAINN National Sexual Assault Hotline (US):</strong> 1-800-656-4673</li>
                                    <li><strong>StopNCII.org</strong> – help removing non-consensual intimate images</li>
                                </ul>
                            </div>
                        </section>

                        <section id="section-10" class="section-block" data-title="10. Changes to This Policy">
                            <h2><span class="section-number">10</span> Changes to This Policy</h2>
                            <p>We may update this AUP. The current version, with its updated date, will always be available on this page.</p>
                        </section>

                    </div>
                    
                    <div class="text-center mt-5 no-print">
                        <h3 class="font-playfair fw-bold mb-3">A Safe Community for Everyone</h3>
                        <p class="text-muted mb-4">By using The Love Project, you agree to these rules.</p>
                        <a href="{{ route('terms') }}" class="btn btn-primary btn-lg px-5 py-3 rounded-pill">Read Our Terms</a>
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
