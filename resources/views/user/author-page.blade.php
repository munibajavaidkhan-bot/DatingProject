<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ $author->name }} — The Love Project</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/site-header-footer.css">

<style>
:root{
  --pink:#ee2c7a;--pink-2:#f43f8e;--purple:#8a2fc0;
  --navy:#23233d;--ink:#1d1d35;--body:#6a6a7a;--page:#f7f5f9;
  --serif:'Playfair Display',serif;--sans:'Poppins',sans-serif;
}
*{margin:0;padding:0;box-sizing:border-box}
html{scroll-behavior:smooth}
body{font-family:var(--sans);background:var(--page);color:var(--body);overflow-x:hidden}
a{text-decoration:none;color:inherit}
img{display:block}
.container{max-width:1220px;margin:0 auto;padding:0 22px}
.reveal{opacity:0;transform:translateY(26px);transition:opacity .7s ease,transform .7s ease}
.reveal.in{opacity:1;transform:none}

.hero{position:relative;overflow:hidden;padding:74px 20px 84px;
  background:linear-gradient(100deg,#b189d8 0%,#d5aede 28%,#f2d2e2 60%,#f9e3ec 100%)}
.hero-still{position:absolute;right:0;top:0;height:100%;width:34%;object-fit:cover;object-position:left center;
  -webkit-mask-image:linear-gradient(to left,#000 62%,transparent 98%);
          mask-image:linear-gradient(to left,#000 62%,transparent 98%)}
.hero-portrait{position:absolute;left:3%;top:50%;transform:translateY(-50%);width:310px;z-index:1;
  filter:drop-shadow(0 22px 44px rgba(120,60,140,.28));object-fit:cover;border-radius:50%}
.hero-inner{position:relative;z-index:2;max-width:540px;margin:0 auto;text-align:center}
.eyebrow{color:var(--pink);font-size:11.5px;font-weight:600;letter-spacing:.22em;text-transform:uppercase}
.mini-div{display:flex;align-items:center;justify-content:center;gap:9px;margin:10px 0}
.mini-div span{width:44px;height:1px;background:#ef8ab5}
.mini-div svg{width:13px;height:12px;color:var(--pink)}
.mini-div.left{justify-content:flex-start;margin:8px 0 0}
.hero h1{font-family:var(--serif);font-weight:600;color:#232d4b;font-size:clamp(38px,4.6vw,52px);line-height:1.15}
.role{font-family:var(--serif);color:var(--pink-2);font-size:18px;font-weight:600;margin-top:6px}
.role i{font-style:normal;margin:0 8px}
.tag{font-size:14.5px;color:#6b6472;line-height:1.8;margin-top:4px}
.hero-socials{display:flex;justify-content:center;gap:14px;margin-top:24px}
.hero-socials a{width:42px;height:42px;border:1.6px solid var(--pink);border-radius:50%;color:var(--pink);
  display:grid;place-items:center;transition:.25s;background:rgba(255,255,255,.35)}
.hero-socials a:hover{background:var(--pink);color:#fff;transform:translateY(-3px)}
.hero-socials svg{width:16px;height:16px}

.about-grid{display:grid;grid-template-columns:1fr 1fr;gap:26px;padding:64px 0 0}
.about-card{position:relative;overflow:hidden;background:#fdfaf8;border:1px solid #f1e5ec;border-radius:16px;
  padding:36px 40px;box-shadow:0 12px 32px rgba(150,90,120,.10)}
.about-card h2{font-family:var(--serif);font-size:24px;color:#232d4b;font-weight:600;position:relative;
  padding-bottom:12px;margin-bottom:20px}
.about-card h2::after{content:'';position:absolute;left:0;bottom:0;width:34px;height:2.5px;border-radius:3px;background:var(--pink)}
.about-card p{font-size:13px;line-height:1.9;margin-bottom:16px}
.floral{position:absolute;right:26px;top:40px;height:70%;width:80px;color:#eb9fb0;opacity:.6;pointer-events:none}
.quote-card{background:#fbeff1;border:1px solid #f6dce4;border-radius:16px;padding:44px 40px;text-align:center;
  position:relative;overflow:hidden;box-shadow:0 12px 32px rgba(150,90,120,.10)}
.quote-card .q{font-family:var(--serif);font-size:56px;line-height:.6;color:var(--pink-2)}
.quote-card p{font-family:var(--serif);font-size:21px;color:#232d4b;line-height:1.65;margin:22px 0 18px}
.q-heart{width:16px;height:15px;color:var(--pink);margin:0 auto}
.quote-card span{display:block;color:var(--pink);font-size:13.5px;font-weight:600;margin-top:12px}

.book-card{margin-top:30px;background:#fbf2f4;border:1px solid #f5dfe7;border-radius:18px;padding:34px;
  display:grid;grid-template-columns:330px 1fr;gap:40px;align-items:center;
  box-shadow:0 14px 36px rgba(150,90,120,.12)}
.book-img img{width:100%;border-radius:6px;filter:drop-shadow(0 26px 40px rgba(90,30,80,.35));transition:.4s}
.book-card:hover .book-img img{transform:translateY(-6px) rotate(-1deg)}
.f-label{color:var(--pink);font-size:11px;font-weight:700;letter-spacing:1.6px;text-transform:uppercase}
.book-body h2{font-family:var(--serif);font-size:clamp(26px,2.8vw,32px);color:#232d4b;font-weight:600;line-height:1.3;margin:10px 0 10px}
.by{font-size:13.5px;color:#7a7a8c}
.by b{color:var(--pink);font-weight:600}
.desc{font-size:13.5px;line-height:1.85;margin-top:14px;max-width:640px}
.book-feats{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;padding:20px 0;border-top:1px solid #f3dbe4}
.bf{display:flex;gap:11px;align-items:flex-start}
.bf svg{width:22px;height:22px;color:var(--pink-2);flex-shrink:0;margin-top:2px}
.bf p{font-size:11.5px;line-height:1.6;color:#6a6a7a}
.book-cta{display:flex;align-items:center;gap:26px;flex-wrap:wrap}
.buy-btn{display:inline-flex;align-items:center;gap:9px;color:#fff;font-size:13.5px;font-weight:600;
  padding:15px 30px;border-radius:999px;background:linear-gradient(95deg,var(--pink-2),var(--pink));
  box-shadow:0 12px 30px rgba(238,44,122,.4);transition:.3s}
.buy-btn:hover{transform:translateY(-3px)}
.view-btn{display:inline-flex;align-items:center;gap:8px;color:var(--pink);font-size:13px;font-weight:600;
  padding:14px 24px;border-radius:999px;border:1.6px solid var(--pink);transition:.3s}
.view-btn:hover{background:var(--pink);color:#fff;transform:translateY(-3px)}

.about-book{padding:64px 0 0;text-align:center}
.center-title{font-family:var(--serif);font-size:26px;color:#232d4b;font-weight:600}
.tri{display:grid;grid-template-columns:repeat(3,1fr);gap:0;margin-top:40px;text-align:left}
.tri-item{display:flex;gap:18px;align-items:flex-start;padding:6px 30px}
.tri-item+.tri-item{border-left:1px solid #ecdbe5}
.tri-item .ico{width:64px;height:64px;border-radius:50%;background:#fdeef4;display:grid;place-items:center;
  color:var(--pink-2);flex-shrink:0;box-shadow:0 8px 20px rgba(238,44,122,.12)}
.tri-item .ico svg{width:28px;height:28px}
.tri-item h3{font-family:var(--serif);font-size:19px;color:#232d4b;font-weight:600;margin-bottom:8px}
.tri-item p{font-size:12.5px;line-height:1.75}

.quote-banner{margin-top:56px;position:relative;overflow:hidden;border-radius:16px;padding:34px 90px;
  text-align:center;color:#fff;background:linear-gradient(95deg,#6d28b8 0%,#a62b96 55%,#f43f8e 100%)}
.quote-banner p{font-family:var(--serif);font-size:19px;line-height:1.8}
.qq{position:absolute;font-family:var(--serif);font-size:64px;line-height:1;color:#fff;opacity:.95}
.qq.open{left:70px;top:26px}
.qq.close{right:70px;bottom:22px}
.qb-heart{position:absolute;color:#ff9ed2;opacity:.4}
.qbh1{width:52px;height:48px;left:26px;top:30px;transform:rotate(-14deg)}
.qbh2{width:30px;height:28px;left:86px;bottom:22px;transform:rotate(10deg)}
.qbh3{width:44px;height:40px;right:30px;top:26px;transform:rotate(12deg)}

.stats{margin-top:26px;background:#fdf7f9;border:1px solid #f3e2ea;border-radius:16px;padding:30px 34px;
  display:grid;grid-template-columns:repeat(4,1fr);box-shadow:0 10px 28px rgba(150,90,120,.08)}
.stat{display:flex;gap:16px;align-items:center;padding:4px 26px}
.stat+.stat{border-left:1px solid #f0dfe8}
.stat .ico{width:56px;height:56px;border-radius:50%;background:#fdeef4;color:var(--pink-2);
  display:grid;place-items:center;flex-shrink:0}
.stat .ico svg{width:24px;height:24px}
.stat b{display:block;font-size:12px;color:#2b2b45;font-weight:600}
.stat .val{display:block;font-family:var(--serif);font-size:19px;color:#232d4b;font-weight:600;margin:3px 0}
.stat small{font-size:11px;color:#8a8a9a}

.writings-head{display:flex;align-items:flex-end;justify-content:space-between;padding:64px 0 26px}
.writings-head h2{font-family:var(--serif);font-size:26px;color:#232d4b;font-weight:600}
.view-all{color:var(--pink);font-size:13px;font-weight:600;display:inline-flex;align-items:center;gap:7px}
.view-all span{transition:.25s}
.view-all:hover span{transform:translateX(4px)}
.writings{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.write-card{display:grid;grid-template-columns:1.05fr .95fr;background:#fbf3f1;border:1px solid #f3e2e6;
  border-radius:14px;overflow:hidden;box-shadow:0 10px 28px rgba(150,90,120,.10);transition:.35s}
.write-card:hover{transform:translateY(-6px);box-shadow:0 22px 48px rgba(190,60,120,.16)}
.write-card img{width:100%;height:100%;object-fit:cover}
.w-content{padding:26px 24px}
.w-label{display:inline-flex;align-items:center;gap:8px;color:var(--pink);font-size:10.5px;font-weight:700;
  letter-spacing:1.4px;text-transform:uppercase}
.w-label svg{width:17px;height:17px}
.w-content h3{font-size:16px;color:#1d1d35;font-weight:600;line-height:1.5;margin:12px 0 10px}
.w-content p{font-size:12.5px;line-height:1.7;margin-bottom:16px}
.w-link{color:var(--pink);font-size:12.5px;font-weight:600;display:inline-flex;align-items:center;gap:7px}
.w-link span{transition:.25s}
.w-link:hover span{transform:translateX(4px)}

.cta{margin:60px 0 0;border-radius:20px;padding:40px 48px;position:relative;overflow:hidden;
  display:flex;align-items:center;gap:26px;flex-wrap:wrap;
  background:linear-gradient(95deg,#7b2bd0 0%,#b0309c 55%,#f43f8e 100%)}
.cta-icon{width:74px;height:74px;background:#fff;border-radius:50%;display:grid;place-items:center;flex-shrink:0;
  box-shadow:0 12px 28px rgba(0,0,0,.22)}
.cta h3{font-size:17px;color:#fff;font-weight:600}
.cta p{font-size:13px;line-height:1.75;margin-top:6px;color:#fbdcec;max-width:400px}
.cta-form{margin-left:auto;display:flex;align-items:center;background:#fff;border-radius:999px;padding:6px;
  width:min(430px,100%);box-shadow:0 14px 34px rgba(0,0,0,.22)}
.cta-form input{flex:1;border:none;outline:none;background:transparent;padding:12px 20px;
  font-family:var(--sans);font-size:13.5px;color:#444}
.cta-form button{border:none;cursor:pointer;color:#fff;font-family:var(--sans);font-size:13.5px;font-weight:600;
  padding:13px 24px;border-radius:999px;display:inline-flex;align-items:center;gap:8px;
  background:linear-gradient(95deg,var(--pink-2),var(--pink));transition:.3s}
.cta-form button:hover{transform:scale(1.04)}
.cta-heart{position:absolute;color:#ffb1d4;opacity:.5}
.ch1{width:30px;height:28px;right:120px;top:16px;transform:rotate(12deg)}
.ch2{width:40px;height:38px;right:66px;top:44px;transform:rotate(-10deg)}
.ch3{width:26px;height:24px;right:110px;bottom:14px;transform:rotate(8deg)}

@media(max-width:1100px){
  .hero-portrait{width:250px;left:2%}
  .book-card{grid-template-columns:1fr;gap:26px}
  .book-img{max-width:320px;margin:0 auto}
  .book-feats{grid-template-columns:1fr 1fr}
  .tri{grid-template-columns:1fr;gap:26px}
  .tri-item+.tri-item{border-left:none}
  .stats{grid-template-columns:1fr 1fr;gap:22px}
  .stat+.stat{border-left:none}
  .writings{grid-template-columns:1fr}
  .about-grid{grid-template-columns:1fr}
}
@media(max-width:720px){
  .hero-portrait,.hero-still{display:none}
  .quote-banner{padding:34px 26px}
  .qq.open{left:12px}.qq.close{right:12px}
  .stats{grid-template-columns:1fr}
  .cta{flex-direction:column;align-items:flex-start}
  .cta-form{margin-left:0}
  .write-card{grid-template-columns:1fr}
  .write-card img{height:180px}
}
</style>
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="heart-o" viewBox="0 0 24 24">
    <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"
        fill="none" stroke="currentColor" stroke-width="1.8"/>
  </symbol>
  <symbol id="heart-f" viewBox="0 0 24 24">
    <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"
        fill="currentColor"/>
  </symbol>
  <symbol id="flor" viewBox="0 0 120 300">
    <g fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
      <path d="M62 298c8-58-8-98 0-148 6-34-4-54 0-76"/>
      <path d="M62 190c-18-8-30-26-28-44"/><ellipse cx="30" cy="136" rx="8" ry="13" transform="rotate(-25 30 136)"/>
      <path d="M62 240c16-6 26-20 26-36"/><ellipse cx="92" cy="194" rx="7" ry="11" transform="rotate(20 92 194)"/>
      <ellipse cx="62" cy="48" rx="9" ry="17"/>
      <ellipse cx="62" cy="48" rx="9" ry="17" transform="rotate(60 62 48)"/>
      <ellipse cx="62" cy="48" rx="9" ry="17" transform="rotate(120 62 48)"/>
      <circle cx="62" cy="48" r="6"/>
    </g>
  </symbol>
</svg>

<!-- HEADER -->
@include('partials.site-header', ['active' => ''])

<!-- HERO -->
<section class="hero">
  <img class="hero-still" src="{{ asset('assets/images/still-life.jpg') }}" alt="">
  <img class="hero-portrait" src="{{ $author->profile_picture ? asset('images/' . $author->profile_picture) : asset('assets/images/author.png') }}" alt="{{ $author->name }}">
  <div class="hero-inner">
    <span class="eyebrow">Meet The Mind Behind The Words</span>
    <div class="mini-div"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
    <h1>{{ $author->name }}</h1>
    <p class="role">Author <i>&bull;</i> Speaker <i>&bull;</i> Storyteller</p>
    <div class="mini-div"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
    <p class="tag">{{ $author->bio ?? 'Helping people understand love, relationships and themselves — one story at a time.' }}</p>
    <div class="hero-socials">
      <a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M13 10h3l-.5 3H13v9h-3v-9H8v-3h2V8.5C10 6 11.5 4 14.5 4H17v3h-2c-1 0-2 .3-2 1.5V10z"/></svg></a>
      <a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg></a>
      <a href="#" aria-label="Twitter"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.3 1.7-2.2-.8.5-1.6.8-2.5 1A3.9 3.9 0 0 0 12 8.9 11 11 0 0 1 4 4.9a3.9 3.9 0 0 0 1.2 5.2c-.6 0-1.2-.2-1.7-.5v.1c0 1.9 1.3 3.5 3.1 3.8-.6.2-1.2.2-1.8.1.5 1.6 2 2.7 3.7 2.7A7.9 7.9 0 0 1 2 18.6a11.2 11.2 0 0 0 6 1.8c7.3 0 11.3-6 11.3-11.3v-.5c.8-.6 1.5-1.3 2-2.1z"/></svg></a>
      <a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M22 12s0-3.3-.4-4.9c-.2-.9-.9-1.6-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.3c-.9.2-1.6.9-1.8 1.8C2 8.7 2 12 2 12s0 3.3.4 4.9c.2.9.9 1.6 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.3c.9-.2 1.6-.9 1.8-1.8.4-1.6.4-4.9.4-4.9z"/><path d="M10 9.5v5l4.5-2.5z" fill="#fff"/></svg></a>
    </div>
  </div>
</section>

<!-- ABOUT + QUOTE -->
<section class="container about-grid">
  <article class="about-card reveal">
    <svg class="floral"><use href="#flor"/></svg>
    <h2>About the Author</h2>
    <p>{{ $author->bio ?? 'Tatiana Brandon is a relationship author and storyteller who writes about love, healing, self-growth and becoming your best self. Her words are inspired by real emotions, real experiences and the journey of finding clarity in a noisy world.' }}</p>
    <p>Through her writing, she helps readers feel seen, understood and less alone.</p>
  </article>

  <aside class="quote-card reveal">
    <div class="q">&ldquo;</div>
    <p>Love isn't about finding perfect people.<br>It's about seeing an<br>imperfect person perfectly.</p>
    <svg class="q-heart"><use href="#heart-f"/></svg>
    <span>&ndash; {{ $author->name }}</span>
  </aside>
</section>

<!-- FEATURED BOOK -->
<section class="container">
  <div class="book-card reveal">
    <div class="book-img"><img src="{{ asset('images/01_hero_book.jpg') }}" alt="The Love Project book cover"></div>
    <div class="book-body">
      <span class="f-label">Featured Book</span>
      <h2>The Love Project:<br>52 Weeks to Forever</h2>
      <p class="by">by <b>{{ $author->name }}</b> (Author)</p>
      <p class="desc">A heartfelt and honest guide to love, dating and self-discovery. 52 weeks of real talk, deep reflections and practical advice to help you heal, grow and build the kind of love that lasts.</p>

      <div class="book-feats">
        <div class="bf"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 6C10 4.2 7 4 4 4v14c3 0 6 .2 8 2 2-1.8 5-2 8-2V4c-3 0-6 .2-8 2z"/><path d="M12 6v14"/></svg><p>Real stories &amp; reflections</p></div>
        <div class="bf"><svg><use href="#heart-o"/></svg><p>Practical dating advice</p></div>
        <div class="bf"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M12 3v3M12 18v3M3 12h3M18 12h3"/></svg><p>Personal growth &amp; healing</p></div>
        <div class="bf"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="9" cy="8" r="3.2"/><circle cx="16.5" cy="9.5" r="2.6"/><path d="M3.5 19c.8-3 3-4.5 5.5-4.5S13.7 16 14.5 19"/></svg><p>Stronger connections &amp; lasting love</p></div>
      </div>

      <div class="book-cta">
        <a class="buy-btn" href="#">Buy on Amazon <span>&rarr;</span></a>
        <a class="view-btn" href="#">View on Amazon
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><path d="M15 3h6v6"/><path d="M10 14L21 3"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- WHAT THIS BOOK IS ABOUT -->
<section class="container about-book reveal">
  <h2 class="center-title">What This Book Is About</h2>
  <div class="mini-div"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
  <div class="tri">
    <div class="tri-item">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"/></svg></span>
      <div><h3>Love</h3><p>Understanding love beyond expectations and building real connection.</p></div>
    </div>
    <div class="tri-item">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 4c-8 0-14 6-14 14v2h2c8 0 14-6 14-14V4z"/><path d="M6 20C8 14 12 10 17 7"/></svg></span>
      <div><h3>Growth</h3><p>Personal growth and mindset shifts that change your relationships.</p></div>
    </div>
    <div class="tri-item">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="2.6"/><ellipse cx="12" cy="6.4" rx="2.4" ry="3"/><ellipse cx="12" cy="17.6" rx="2.4" ry="3"/><ellipse cx="6.4" cy="12" rx="3" ry="2.4"/><ellipse cx="17.6" cy="12" rx="3" ry="2.4"/></svg></span>
      <div><h3>Healing</h3><p>Healing from past hurts and building a peaceful inner world.</p></div>
    </div>
  </div>
</section>

<!-- QUOTE BANNER -->
<div class="container">
  <div class="quote-banner reveal">
    <svg class="qb-heart qbh1"><use href="#heart-o"/></svg>
    <svg class="qb-heart qbh2"><use href="#heart-o"/></svg>
    <svg class="qb-heart qbh3"><use href="#heart-o"/></svg>
    <span class="qq open">&ldquo;</span>
    <p>Every chapter is a piece of my heart.<br>I wrote this book for the you that needed it the most.</p>
    <span class="qq close">&rdquo;</span>
  </div>
</div>

<!-- STATS -->
<div class="container">
  <div class="stats reveal">
    <div class="stat">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 3l4 4L8 20l-5 1 1-5z"/></svg></span>
      <div><b>Author</b><span class="val">{{ $author->name }}</span><small>Relationship Author</small></div>
    </div>
    <div class="stat">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 6C10 4.2 7 4 4 4v14c3 0 6 .2 8 2 2-1.8 5-2 8-2V4c-3 0-6 .2-8 2z"/><path d="M12 6v14"/></svg></span>
      <div><b>Writings Published</b><span class="val">{{ $articleCount + $storyCount + $poemCount }}</span><small>and counting</small></div>
    </div>
    <div class="stat">
      <span class="ico"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M5 21c1.5-4 4-6 7-6s5.5 2 7 6"/></svg></span>
      <div><b>Articles</b><span class="val">{{ $articleCount }}</span><small>published</small></div>
    </div>
    <div class="stat">
      <span class="ico"><svg><use href="#heart-o"/></svg></span>
      <div><b>Stories</b><span class="val">{{ $storyCount }}</span><small>published</small></div>
    </div>
  </div>
</div>

<!-- WRITINGS -->
<section class="container">
  <div class="writings-head reveal">
    <div>
      <h2>Author's Writings</h2>
      <div class="mini-div left"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
    </div>
  </div>

  <div class="writings">
    @if($articles->count())
    <article class="write-card reveal">
      <div class="w-content">
        <span class="w-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7z"/><path d="M14 2v5h5"/><path d="M9 13h6M9 17h4"/></svg>Articles</span>
        <h3>Dating &amp; Relationship Advice</h3>
        <p>Insights and advice on love, dating and relationships.</p>
        <a class="w-link" href="{{ route('articles.index') }}">Read Articles <span>&rarr;</span></a>
      </div>
      @if($articles->first()?->cover_image)
      <img src="{{ asset('images/' . $articles->first()->cover_image) }}" alt="Articles">
      @endif
    </article>
    @endif

    @if($stories->count())
    <article class="write-card reveal">
      <div class="w-content">
        <span class="w-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7z"/><path d="M14 2v5h5"/></svg>Stories</span>
        <h3>Real Stories That Inspire</h3>
        <p>Real stories that inspire, heal and make you think.</p>
        <a class="w-link" href="{{ route('stories.index') }}">Read Stories <span>&rarr;</span></a>
      </div>
      @if($stories->first()?->cover_image)
      <img src="{{ asset('images/' . $stories->first()->cover_image) }}" alt="Stories">
      @endif
    </article>
    @endif

    @if($poems->count())
    <article class="write-card reveal">
      <div class="w-content">
        <span class="w-label"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M19 3l-4 10 4 8H5l4-8L5 3z" transform="scale(.9) translate(1.2 1.2)"/></svg>Poems</span>
        <h3>Poems That Speak What We Feel</h3>
        <p>Poems that touch your heart and heal your soul.</p>
        <a class="w-link" href="{{ route('poems.index') }}">Read Poems <span>&rarr;</span></a>
      </div>
      @if($poems->first()?->cover_image)
      <img src="{{ asset('images/' . $poems->first()->cover_image) }}" alt="Poems">
      @endif
    </article>
    @endif
  </div>

  <!-- CTA -->
  <div class="cta reveal">
    <span class="cta-icon">
      <svg width="30" height="30" viewBox="0 0 24 24" fill="none">
        <rect x="3" y="5" width="18" height="14" rx="3" stroke="#ee2c7a" stroke-width="1.8"/>
        <path d="M12 13.4l-2.2-2a1.5 1.5 0 0 1 2.2-1.9 1.5 1.5 0 0 1 2.2 1.9z" fill="#ee2c7a"/>
        <path d="M3.5 7l8.5 6 8.5-6" stroke="#ee2c7a" stroke-width="1.8"/>
      </svg>
    </span>
    <div>
      <h3>Stay connected with new stories &amp; insights.</h3>
      <p>Get the best stories, articles and dating insights straight to your inbox.</p>
    </div>
    <form class="cta-form">
      <input type="email" placeholder="Your email">
      <button type="submit">Subscribe <span>&rarr;</span></button>
    </form>
    <svg class="cta-heart ch1"><use href="#heart-o"/></svg>
    <svg class="cta-heart ch2"><use href="#heart-o"/></svg>
    <svg class="cta-heart ch3"><use href="#heart-o"/></svg>
  </div>
</section>

<!-- FOOTER -->
@include('partials.site-footer')

<script>
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}}),{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>
</body>
</html>
