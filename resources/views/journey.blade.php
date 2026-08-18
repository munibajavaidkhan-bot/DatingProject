<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>The Love Project — The 52-Week Love Journey</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/site-header-footer.css">

<style>
/* ============ BASE ============ */
*{margin:0;padding:0;box-sizing:border-box}
:root{
  --pink:#e91e75; --pink2:#f43f8e; --purple:#8a2fc0;
  --ink:#1c2340; --muted:#6b7186; --bg:#f6f4f8;
}
html{scroll-behavior:smooth}
body{font-family:'Poppins',sans-serif;background:var(--bg);color:var(--ink);overflow-x:hidden}
img{display:block;max-width:100%}
a{text-decoration:none}
ul{list-style:none}
.container{max-width:1160px;margin:0 auto;padding:0 24px}
.eyebrow{display:block;font-size:11px;font-weight:700;letter-spacing:.24em;text-transform:uppercase;color:var(--pink)}
.sec-title{font-family:'Playfair Display',serif;font-size:34px;font-weight:600;color:var(--ink);margin:12px 0 12px}
.sec-title em{color:var(--pink);font-style:italic}
.sec-sub{font-size:13px;color:var(--muted);max-width:580px;margin:0 auto;line-height:1.75}
.reveal{opacity:0;transform:translateY(26px);transition:all .7s ease}
.reveal.in{opacity:1;transform:none}

/* ============ HEADER ============ */
.site-header{position:sticky;top:0;z-index:100;background:rgba(250,248,252,.95);backdrop-filter:blur(8px);box-shadow:0 1px 0 rgba(28,35,64,.07)}
.header-in{display:flex;align-items:center;justify-content:space-between;height:64px;gap:20px}
.brand{display:flex;align-items:center;gap:10px}
.brand svg{width:34px;height:34px}
.brand-t b{display:block;font-size:13px;font-weight:700;letter-spacing:.2em;color:var(--pink)}
.brand-t small{display:block;font-size:9px;letter-spacing:.32em;color:var(--purple);font-weight:600}
.nav{display:flex;gap:26px;align-items:center}
.nav a{font-size:13px;font-weight:500;color:var(--ink);position:relative}
.nav a.active{color:var(--pink)}
.nav a.active::after{content:"";position:absolute;left:0;right:0;bottom:-8px;height:2px;border-radius:2px;background:var(--pink)}
.btn-signin{display:inline-flex;align-items:center;gap:8px;background:var(--pink);color:#fff;font-size:12.5px;font-weight:600;padding:10px 24px;border-radius:999px;box-shadow:0 6px 16px rgba(233,30,117,.35)}
.btn-signin svg{width:14px;height:14px}

/* ============ HERO (fixed) ============ */
.hero{position:relative;overflow:hidden;background:linear-gradient(135deg,#fdf2f8 0%,#fce7f3 30%,#fbcfe8 60%,#f9a8d4 100%)}
.hero-grid{position:relative;z-index:3;display:flex;align-items:center;min-height:560px;padding:60px 0}
.hero-copy{max-width:520px}
.hero h1{font-family:'Playfair Display',serif;font-size:54px;line-height:1.08;font-weight:600;color:var(--ink);margin:14px 0 20px}
.hero h1 em{display:block;color:var(--pink);font-style:italic}
.hero-copy p{font-size:14px;color:#5d6478;max-width:440px;line-height:1.8}
.chips{display:flex;gap:12px;margin-top:32px;flex-wrap:wrap}
.chip{display:flex;align-items:center;gap:10px;background:#fff;border-radius:10px;padding:10px 16px;box-shadow:0 6px 20px rgba(120,60,120,.1);transition:transform .3s,box-shadow .3s}
.chip:hover{transform:translateY(-2px);box-shadow:0 10px 28px rgba(120,60,120,.15)}
.chip svg{width:18px;height:18px;color:var(--pink);flex:none}
.chip b{display:block;font-size:13px;color:var(--pink);line-height:1.15}
.chip small{display:block;font-size:10px;color:#8a8fa3}

/* right visual: .hero direct child = full bleed to viewport right edge */
.hero-visual{position:absolute;top:0;right:0;bottom:0;width:50%;z-index:1}
.hero-still{position:absolute;top:0;left:0;right:0;bottom:0;width:100%;height:100%;object-fit:cover;
  -webkit-mask-image:linear-gradient(to right,rgba(0,0,0,0) 0%,rgba(0,0,0,1) 32%);
          mask-image:linear-gradient(to right,rgba(0,0,0,0) 0%,rgba(0,0,0,1) 32%)}
/* fallback blend agar mask support na ho */
.hero-visual::before{content:"";position:absolute;top:0;left:0;bottom:0;width:34%;z-index:1;
  background:linear-gradient(to right,#f6dbe6 0%,rgba(246,219,230,0) 100%);pointer-events:none}
.hero-book{position:absolute;z-index:2;top:50%;transform:translateY(-50%);left:4%;
  width:320px;max-width:62%;border-radius:6px;box-shadow:0 30px 70px rgba(90,20,60,.38)}

/* ============ WHAT IS IT ============ */
.what{padding:84px 24px 20px;text-align:center}
.info-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:22px;margin-top:46px;text-align:left}
.info-card{background:#fdfcfe;border:1px solid #f0e7f2;border-radius:14px;padding:28px 26px;box-shadow:0 10px 26px rgba(120,60,120,.07)}
.info-ico{width:46px;height:46px;border-radius:50%;background:linear-gradient(135deg,var(--pink),var(--purple));display:flex;align-items:center;justify-content:center;color:#fff;margin-bottom:18px;box-shadow:0 8px 18px rgba(233,30,117,.3)}
.info-ico svg{width:20px;height:20px}
.info-card h3{font-size:15.5px;font-weight:600;margin-bottom:10px}
.info-card p{font-size:12.5px;color:var(--muted);line-height:1.75}

/* ============ CURRICULUM ============ */
.curr-sec{padding:80px 24px 10px;text-align:center}
.curr{display:grid;grid-template-columns:.92fr 1.08fr;gap:44px;align-items:center;margin-top:46px;text-align:left}
.timeline{position:relative;padding-left:34px}
.timeline::before{content:"";position:absolute;left:10px;top:10px;bottom:14px;width:2px;background:linear-gradient(var(--pink2),var(--purple))}
.phase{position:relative;padding-bottom:26px}
.phase:last-child{padding-bottom:0}
.phase .node{position:absolute;left:-31px;top:1px;width:20px;height:20px;border-radius:50%;background:#fff;border:2px solid var(--pink2);color:var(--pink2);display:flex;align-items:center;justify-content:center}
.phase .node svg{width:10px;height:10px}
.phase .weeks{font-size:11.5px;color:#8a8fa3}
.phase h4{font-size:14px;font-weight:600;margin:6px 0 10px}
.phase li{font-size:12px;color:var(--muted);padding-left:16px;position:relative;margin-bottom:7px}
.phase li::before{content:"";position:absolute;left:0;top:6px;width:5px;height:5px;border-radius:50%;background:var(--pink2)}
.journey img{width:100%;border-radius:18px;box-shadow:0 24px 60px rgba(90,30,90,.28)}

/* ============ TOPICS ============ */
.topics-sec{padding:80px 24px 10px;text-align:center}
.topics{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap;margin-top:48px}
.topic{display:flex;flex-direction:column;align-items:center;gap:11px;width:92px}
.topic svg{width:34px;height:34px}
.topic span{font-size:11.5px;font-weight:600;color:#333a52;text-align:center;line-height:1.35}

/* ============ CTA ============ */
.cta-wrap{padding:70px 0 64px}
.cta{position:relative;border-radius:22px;background:linear-gradient(100deg,#e5187f 0%,#a222c8 60%,#7d2bd0 100%);text-align:center;padding:58px 30px;overflow:hidden;color:#fff;box-shadow:0 24px 60px rgba(150,30,140,.35)}
.cta h2{font-family:'Playfair Display',serif;font-size:30px;font-weight:600;position:relative;z-index:2}
.cta p{font-size:12.5px;color:rgba(255,255,255,.88);margin:12px 0 28px;line-height:1.75;position:relative;z-index:2}
.cta-btns{display:flex;gap:14px;justify-content:center;flex-wrap:wrap;position:relative;z-index:2}
.btn-white{display:inline-flex;align-items:center;gap:8px;background:#fff;color:var(--pink);font-size:12.5px;font-weight:600;padding:13px 26px;border-radius:999px;box-shadow:0 10px 24px rgba(0,0,0,.18);transition:transform .3s,box-shadow .3s}
.btn-white:hover{transform:translateY(-2px);box-shadow:0 14px 30px rgba(0,0,0,.22)}
.btn-white svg{width:15px;height:15px;color:var(--pink)}
.btn-outline{display:inline-flex;align-items:center;border:1.5px solid rgba(255,255,255,.7);color:#fff;padding:12px 28px;border-radius:999px;font-size:12.5px;font-weight:600;transition:background .3s,border-color .3s}
.btn-outline:hover{background:rgba(255,255,255,.15);border-color:#fff}

/* Floating Hearts */
.cta-hearts-float{position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:1}
.cta-hearts-float .heart{position:absolute;color:rgba(255,255,255,.2);animation:floatHeart 4s ease-in-out infinite}
.cta-hearts-float .heart-1{width:60px;height:60px;top:20%;left:8%;animation-delay:0s;opacity:.9}
.cta-hearts-float .heart-2{width:35px;height:35px;top:60%;left:12%;animation-delay:1s;opacity:.7}
.cta-hearts-float .heart-3{width:25px;height:25px;top:35%;left:18%;animation-delay:2s;opacity:.6}
.cta-hearts-float .heart-4{width:45px;height:45px;top:15%;right:10%;animation-delay:0.5s;opacity:.8}
.cta-hearts-float .heart-5{width:30px;height:30px;top:55%;right:15%;animation-delay:1.5s;opacity:.65}
@keyframes floatHeart{0%,100%{transform:translateY(0) rotate(0deg)}50%{transform:translateY(-12px) rotate(5deg)}}

/* ============ FOOTER ============ */
.site-footer{background:#141830;color:#9aa0b8}
.footer-grid{display:grid;grid-template-columns:1.25fr 1fr 1fr 1.25fr;gap:40px;padding:60px 0 44px}
.f-brand{display:flex;align-items:center;gap:10px}
.f-brand svg{width:38px;height:38px}
.f-text{font-size:12px;line-height:1.85;margin:16px 0 20px}
.socials{display:flex;gap:10px}
.socials a{width:34px;height:34px;border-radius:50%;border:1px solid #2c3153;display:flex;align-items:center;justify-content:center;color:#c9cde0;transition:.3s}
.socials a:hover{background:var(--pink);border-color:var(--pink);color:#fff}
.socials svg{width:14px;height:14px}
.f-col h4{color:#fff;font-size:13.5px;font-weight:600;padding-bottom:12px;margin-bottom:16px;position:relative}
.f-col h4::after{content:"";position:absolute;left:0;bottom:0;width:26px;height:2px;background:var(--pink)}
.f-col a{display:block;font-size:12px;color:#9aa0b8;margin-bottom:11px;transition:.25s}
.f-col a:hover{color:var(--pink2)}
.news-form{display:flex;align-items:center;background:#1d2242;border-radius:10px;padding:4px;margin-top:16px}
.news-form input{flex:1;background:transparent;border:0;outline:0;color:#fff;font-size:12px;padding:10px 12px;font-family:'Poppins'}
.news-form input::placeholder{color:#767b96}
.news-form button{width:36px;height:36px;flex:none;border-radius:50%;background:var(--pink);border:0;color:#fff;cursor:pointer}
.footer-bottom{border-top:1px solid #23284a;padding:18px 0;display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;font-size:11.5px;color:#8b90a8}
.footer-bottom nav{display:flex;gap:34px}
.footer-bottom a{color:#8b90a8}
.footer-bottom a:hover{color:var(--pink2)}

/* ============ RESPONSIVE ============ */
@media (max-width:1024px){
  .hero-grid{min-height:0;padding:48px 0 8px}
  .hero-visual{position:relative;top:auto;right:auto;bottom:auto;width:100%;height:460px;margin-top:36px}
  .hero-still{-webkit-mask-image:linear-gradient(to bottom,rgba(0,0,0,0) 0%,rgba(0,0,0,1) 22%);mask-image:linear-gradient(to bottom,rgba(0,0,0,0) 0%,rgba(0,0,0,1) 22%)}
  .hero-visual::before{width:100%;height:30%;bottom:auto;background:linear-gradient(to bottom,#fdf2f8 0%,rgba(253,242,248,0) 100%)}
  .hero-book{left:50%;top:54%;transform:translate(-50%,-50%)}
  .curr{grid-template-columns:1fr}
  .footer-grid{grid-template-columns:1fr 1fr}
}
@media (max-width:900px){
  .nav{display:none}
  .info-grid{grid-template-columns:1fr}
  .topics{justify-content:center;gap:28px}
}
@media (max-width:600px){
  .hero h1{font-size:38px}
  .sec-title{font-size:27px}
  .footer-grid{grid-template-columns:1fr}
  .cta-hearts-float .heart{display:none}
}
</style>
</head>
<body>

<!-- HEADER -->
@include('partials.site-header', ['active' => 'journey'])

<!-- HERO -->
<section class="hero">
  <div class="container hero-grid">
    <div class="hero-copy reveal in">
      <span class="eyebrow">One Lesson A Week</span>
      <h1>The 52-Week <em>Love Journey</em></h1>
      <p>A full year of guided lessons, exercises and journal prompts — designed to help you know yourself, communicate better and build love that lasts.</p>
      <div class="chips">
        <div class="chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M8 3v4M16 3v4M3 10h18"/></svg><div><b>52</b><small>Weeks</small></div></div>
        <div class="chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 3l9 5-9 5-9-5z"/><path d="M3 13l9 5 9-5"/></svg><div><b>4</b><small>Phases</small></div></div>
        <div class="chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg><div><b>10+</b><small>Themes</small></div></div>
        <div class="chip"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><div><b>~20</b><small>min each</small></div></div>
      </div>
    </div>
  </div>

  <!-- visual: .hero direct child = will never be hidden/clipped -->
  <div class="hero-visual">
    <img class="hero-still" src="{{ asset('images/02_hero_flowers_vase.jpg') }}" alt="" loading="eager">
    <img class="hero-book" src="{{ asset('images/01_hero_book.jpg') }}" alt="The Love Project book" loading="eager">
  </div>
</section>

<!-- WHAT IS IT -->
<section class="what container">
  <span class="eyebrow reveal">What Is It?</span>
  <h2 class="sec-title reveal">A complete blueprint for <em>lasting love</em></h2>
  <p class="sec-sub reveal">The Love Project is a <b>52-week guided program</b>. Every week you unlock one short lesson with practical exercises — start wherever you are, grow one week at a time.</p>

  <div class="info-grid">
    <article class="info-card reveal">
      <span class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="3"/><path d="M8 3v4M16 3v4M3 10h18"/></svg></span>
      <h3>Weekly lessons</h3>
      <p>Short, focused lessons (~20 min) on everything from self-awareness to commitment — one new topic each week.</p>
    </article>
    <article class="info-card reveal">
      <span class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3l4 4L8 20l-5 1 1-5z"/></svg></span>
      <h3>Exercises &amp; journaling</h3>
      <p>Practical exercises, affirmations and reflection questions so lessons become real habits, not just reading.</p>
    </article>
    <article class="info-card reveal">
      <span class="info-ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="3"/><path d="M7 14l3-3 3 2 4-5"/></svg></span>
      <h3>Progress tracking</h3>
      <p>Your journey unlocks week by week, and your dashboard tracks every completed lesson across the full year.</p>
    </article>
  </div>
</section>

<!-- CURRICULUM -->
<section class="curr-sec container">
  <span class="eyebrow reveal">The Curriculum</span>
  <h2 class="sec-title reveal">What you'll learn in <em>52 weeks</em></h2>
  <p class="sec-sub reveal">Your journey is divided into four phases — each building on the last.</p>

  <div class="curr">
    <div class="timeline reveal">
      <div class="phase">
        <span class="node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span class="weeks">Weeks 1–12</span>
        <h4>Phase 1 · Know Yourself</h4>
        <ul>
          <li>Your attachment style and how you love</li>
          <li>Your core values and non-negotiables</li>
          <li>Recognising patterns from past relationships</li>
          <li>Healing what holds you back</li>
        </ul>
      </div>
      <div class="phase">
        <span class="node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span class="weeks">Weeks 13–24</span>
        <h4>Phase 2 · Communicate &amp; Connect</h4>
        <ul>
          <li>Emotional intelligence &amp; active listening</li>
          <li>Vulnerability and building trust</li>
          <li>Speaking up without fear</li>
          <li>Dating with intention and clarity</li>
        </ul>
      </div>
      <div class="phase">
        <span class="node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span class="weeks">Weeks 25–36</span>
        <h4>Phase 3 · Build Deep Intimacy</h4>
        <ul>
          <li>Healthy conflict — turning fights into growth</li>
          <li>Emotional &amp; physical intimacy that lasts</li>
          <li>Appreciation and daily connection rituals</li>
          <li>Trust, loyalty and keeping the spark alive</li>
        </ul>
      </div>
      <div class="phase">
        <span class="node"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span class="weeks">Weeks 37–52</span>
        <h4>Phase 4 · Create Your Future</h4>
        <ul>
          <li>Shared values, money &amp; family planning</li>
          <li>Vision-building as a couple</li>
          <li>Growing together, not apart</li>
          <li>Commitment and lasting partnership</li>
        </ul>
      </div>
    </div>
    <div class="journey reveal"><img src="{{ asset('images/03_curriculum_journey_art.jpg') }}" alt="The 4-phase journey path"></div>
  </div>
</section>

<!-- TOPICS -->
<section class="topics-sec container">
  <span class="eyebrow reveal">Topics Covered</span>
  <h2 class="sec-title reveal">Ten themes across <em>the year</em></h2>

  <div class="topics reveal">
    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg1" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg1)" d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg><span>Self Discovery</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg2" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg2)" d="M21 11.5a8.5 8.5 0 0 1-8.5 8.5H4l1.8-2.8A8.5 8.5 0 1 1 21 11.5z"/><path stroke="url(#tg2)" d="M8.5 11.5h.01M12 11.5h.01M15.5 11.5h.01"/></svg><span>Communication</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg3" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg3)" d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/><path stroke="url(#tg3)" d="M7 11h2l1.5-2.5L13 13l1.5-2H17"/></svg><span>Emotional Intelligence</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg4" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg4)" d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg><span>Intimacy</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg5" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><circle stroke="url(#tg5)" cx="12" cy="12" r="3"/><path stroke="url(#tg5)" d="M12 4v3M12 17v3M4 12h3M17 12h3M6.3 6.3l2 2M15.7 15.7l2 2M17.7 6.3l-2 2M8.3 15.7l-2 2"/></svg><span>Conflict Resolution</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg6" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><circle stroke="url(#tg6)" cx="9" cy="9" r="4.5"/><circle stroke="url(#tg6)" cx="15" cy="15" r="4.5"/></svg><span>Shared Values</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg7" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><circle stroke="url(#tg7)" cx="12" cy="7" r="3"/><path stroke="url(#tg7)" d="M6 21c.8-4 3-6 6-6s5.2 2 6 6"/><path stroke="url(#tg7)" d="M12 12l2.5-1.5"/></svg><span>Future Planning</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg8" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><circle stroke="url(#tg8)" cx="12" cy="12" r="2.6"/><ellipse stroke="url(#tg8)" cx="12" cy="6.4" rx="2.4" ry="3"/><ellipse stroke="url(#tg8)" cx="12" cy="17.6" rx="2.4" ry="3"/><ellipse stroke="url(#tg8)" cx="6.4" cy="12" rx="3" ry="2.4"/><ellipse stroke="url(#tg8)" cx="17.6" cy="12" rx="3" ry="2.4"/></svg><span>Appreciation</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg9" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg9)" d="M12 3l8 3v6c0 5-3.5 8-8 9-4.5-1-8-4-8-9V6z"/><path stroke="url(#tg9)" d="M9 12l2 2 4-4"/></svg><span>Trust Building</span></div>

    <div class="topic"><svg viewBox="0 0 24 24" fill="none" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><defs><linearGradient id="tg10" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs><path stroke="url(#tg10)" d="M20 4c-8 0-14 6-14 14v2h2c8 0 14-6 14-14V4z"/><path stroke="url(#tg10)" d="M6 20C8 14 12 10 17 7"/></svg><span>Growth</span></div>
  </div>
</section>

<!-- CTA -->
<div class="container cta-wrap">
  <div class="cta reveal">
    <!-- Floating Hearts -->
    <div class="cta-hearts-float">
      <svg class="heart heart-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>
      <svg class="heart heart-2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>
      <svg class="heart heart-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>
      <svg class="heart heart-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>
      <svg class="heart heart-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>
    </div>
    <h2>Start your journey to love today</h2>
    <p>Create your free profile, complete a quick quiz,<br>and unlock the first weeks of your 52-week journey.</p>
    <div class="cta-btns">
      <a class="btn-white" href="{{ route('register') }}"><svg width="16" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg>Register as a Dating User</a>
      <a class="btn-outline" href="{{ route('login') }}">Sign In</a>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <a class="f-brand" href="#">
          <svg viewBox="0 0 24 24" fill="none"><defs><linearGradient id="bfg" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#f43f8e"/><stop offset="1" stop-color="#8a2fc0"/></linearGradient></defs>
            <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z" stroke="url(#bfg)" stroke-width="2"/>
          </svg>
          <span class="brand-t"><b>LOVE</b><small style="color:#b76ee0">PROJECT</small></span>
        </a>
        <p class="f-text">52 Weeks to become the person you attract. Build better connections and find love that lasts.</p>
        <div class="socials">
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M14 8h3V5h-3c-2.2 0-4 1.8-4 4v2H7v3h3v7h3v-7h3l1-3h-4V9c0-.6.4-1 1-1z"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8c-.7.3-1.5.6-2.3.7.8-.5 1.5-1.3 1.8-2.2-.8.5-1.7.8-2.6 1A4.1 4.1 0 0 0 12 8.9 11.7 11.7 0 0 1 3.5 4.6a4.1 4.1 0 0 0 1.3 5.5c-.7 0-1.3-.2-1.9-.5v.1c0 2 1.4 3.6 3.3 4-.6.2-1.2.2-1.9.1a4.1 4.1 0 0 0 3.8 2.9A8.3 8.3 0 0 1 2 18.4a11.7 11.7 0 0 0 6.3 1.8c7.5 0 11.7-6.3 11.7-11.7v-.5c.8-.6 1.5-1.3 2-2.2z"/></svg></a>
          <a href="#"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M21.6 7.2a2.8 2.8 0 0 0-2-2C17.9 4.8 12 4.8 12 4.8s-5.9 0-7.6.4a2.8 2.8 0 0 0-2 2A29 29 0 0 0 2 12a29 29 0 0 0 .4 4.8 2.8 2.8 0 0 0 2 2c1.7.4 7.6.4 7.6.4s5.9 0 7.6-.4a2.8 2.8 0 0 0 2-2A29 29 0 0 0 22 12a29 29 0 0 0-.4-4.8zM9.8 15.1V8.9L15.2 12l-5.4 3.1z"/></svg></a>
        </div>
      </div>
      <div class="f-col">
        <h4>Quick Links</h4>
        <a href="#">About Us</a><a href="#">How It Works</a><a href="#">52 Weeks Journey</a><a href="#">Poems</a><a href="#">Resources</a><a href="#">Pricing</a><a href="#">Blog</a>
      </div>
      <div class="f-col">
        <h4>Resources</h4>
        <a href="#">Articles</a><a href="#">Stories</a><a href="#">Poems</a><a href="#">Community</a><a href="#">Guides</a>
      </div>
      <div class="f-col">
        <h4>Newsletter</h4>
        <p class="f-text" style="margin:0">Get the best poems, stories and dating insights in your inbox.</p>
        <form class="news-form" onsubmit="return false">
          <input type="email" placeholder="Your email">
          <button type="submit"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4z"/></svg></button>
        </form>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© 2026 The Love Project. All rights reserved.</span>
      <nav><a href="#">Terms</a><a href="#">Privacy</a><a href="#">Cookies</a></nav>
    </div>
  </div>
</footer>

<script>
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}}),{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>
</body>
</html>