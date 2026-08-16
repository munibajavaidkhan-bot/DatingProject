<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ $poem->title }} — The Love Project</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/poems.css') }}">
</head>
<body>

<!-- SVG SYMBOLS -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="heart-o" viewBox="0 0 24 24">
    <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"
      fill="none" stroke="currentColor" stroke-width="1.8"/>
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
@include('partials.site-header', ['active' => 'poems'])

<!-- HERO -->
<section class="hero hero-sub">
  <img class="hero-art-left"  src="{{ asset('assets/images/hero-left.jpg') }}"  alt="">
  <img class="hero-art-right" src="{{ asset('assets/images/hero-right.jpg') }}" alt="">
  <div class="hero-inner">
    <span class="eyebrow">Words From The Heart</span>
    <h1><em>{{ $poem->title }}</em></h1>
    <div class="divider"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
  </div>
</section>

<!-- POEM DETAIL -->
<section class="poems">
  <div class="container">
    <article class="poem-article reveal">
      @if($poem->cover_image)
      <img class="poem-cover"
           src="{{ str_starts_with($poem->cover_image, 'poems/') ? asset('storage/' . $poem->cover_image) : asset('assets/images/' . $poem->cover_image) }}"
           alt="{{ $poem->title }}">
      @endif

      <div class="poem-meta">
        @if($poem->author)
        <span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
            <circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6"/>
          </svg>
          {{ $poem->author->name }}
        </span>
        @endif
        @if($poem->published_at)
        <span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
            <rect x="3" y="5" width="18" height="16" rx="3"/><path d="M3 10h18M8 3v4M16 3v4"/>
          </svg>
          {{ $poem->published_at->format('M d, Y') }}
        </span>
        @endif
        <span>
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
            <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>
          </svg>
          {{ $poem->views }} views
        </span>
      </div>

      <div class="poem-body">
        {!! nl2br(e($poem->body)) !!}
      </div>

      <div class="poem-back">
        <a class="back-link" href="{{ route('poems.index') }}">
          <span>&larr;</span> Back To Poems
        </a>
      </div>
    </article>
  </div>
</section>

<!-- FOOTER -->
@include('partials.site-footer', ['active' => 'poems'])

<script>
/* Scroll-reveal animation */
const io = new IntersectionObserver(entries=>{
  entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
},{threshold:.12});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>
</body>
</html>