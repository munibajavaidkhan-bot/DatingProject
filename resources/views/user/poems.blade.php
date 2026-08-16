<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>The Love Project — Poems That Speak What We Feel</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/poems.css">
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
<section class="hero">
  <img class="hero-art-left"  src="{{ asset('assets/images/hero-left.jpg') }}"  alt="">
  <img class="hero-art-right" src="{{ asset('assets/images/hero-right.jpg') }}" alt="">
  <div class="hero-inner">
    <span class="eyebrow">Words From The Heart</span>
    <h1>Poems That Speak<br><em>What We Feel</em></h1>
    <p>Heartfelt poems about love, loss, closure,<br>healing and choosing yourself.</p>
    <div class="divider"><span></span><svg><use href="#heart-o"/></svg><span></span></div>
    <form class="search" action="{{ route('poems.index') }}" method="GET">
      <input type="text" name="search" placeholder="Search poems..." value="{{ request('search') }}">
      <button aria-label="Search">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.4">
          <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
        </svg>
      </button>
    </form>
  </div>
</section>

<!-- POEMS -->
<section class="poems">
  <div class="container">

    <div class="sec-head reveal">
      <span class="eyebrow">Words From The Heart</span>
      <h2>Ten Poems, Ten <em>Feelings</em></h2>
      <p>Har card ek ehsaas hai — jo shayad aap ne kabhi lafzon me na kaha ho.</p>
    </div>

    <div class="grid">
      @forelse($poems as $i => $poem)
      <article class="card reveal {{ $i % 7 === 4 ? 'tall' : '' }} {{ $i % 7 === 6 ? 'half' : '' }}">
        <svg class="floral"><use href="#flor"/></svg>
        <div class="q">&ldquo;</div><span class="num">{{ str_pad(($poems->firstItem() ?? 0) + $i, 2, '0', STR_PAD_LEFT) }}</span>
        <h3>{{ $poem->title }}</h3>
        <p>{{ $poem->excerpt ?: Str::limit(strip_tags($poem->body), 130) }}</p>
        <a class="read" href="{{ route('poems.show', $poem->slug) }}">Read Poem <span>&rarr;</span></a>
      </article>
      @empty
      <div class="empty" style="grid-column:1/-1">
        <h3>No poems found</h3>
        <p>Kuchh bhi nahi mila — thodi aur koshish karein ya baad me aayein.</p>
      </div>
      @endforelse
    </div>

    @if($poems->hasPages())
    <nav class="pagination">
      @if($poems->onFirstPage())
        <span class="disabled">&larr;</span>
      @else
        <a href="{{ $poems->previousPageUrl() }}">&larr;</a>
      @endif

      @foreach($poems->getUrlRange(1, $poems->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="{{ $page === $poems->currentPage() ? 'active' : '' }}">{{ $page }}</a>
      @endforeach

      @if($poems->hasMorePages())
        <a href="{{ $poems->nextPageUrl() }}">&rarr;</a>
      @else
        <span class="disabled">&rarr;</span>
      @endif
    </nav>
    @endif

    @if($featured)
    <!-- FEATURED -->
    <div class="featured reveal">
      <img class="f-left"  src="{{ asset('assets/images/couple.jpg') }}"    alt="">
      <img class="f-right" src="{{ asset('assets/images/neon-book.jpg') }}" alt="">

      <span class="fh fh1"><svg><use href="#heart-o"/></svg></span>
      <span class="fh fh2"><svg><use href="#heart-o"/></svg></span>
      <span class="fh fh3"><svg><use href="#heart-o"/></svg></span>
      <span class="fh fh4"><svg><use href="#heart-o"/></svg></span>

      <div class="f-inner">
        <span class="f-label"><svg><use href="#heart-o"/></svg> Featured Poem</span>
        <h2>{{ $featured->title }} <svg><use href="#heart-o"/></svg></h2>
        <p>{!! nl2br(e($featured->excerpt)) !!}</p>
        @if($featured->author)
        <span class="f-credit">&mdash; {{ $featured->author->name }}</span>
        @endif
        <a class="f-btn" href="{{ route('poems.show', $featured->slug) }}">Read Full Poem <span>&rarr;</span></a>
      </div>
    </div>
    @endif

    <!-- SHARE -->
    <div class="share-box reveal">
      <div class="share-left">
        <span class="share-icon">
          <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
            <path d="M12 6C10 4.2 7 4 4 4v14c3 0 6 .2 8 2 2-1.8 5-2 8-2V4c-3 0-6 .2-8 2z" stroke="#fff" stroke-width="1.8"/>
            <path d="M12 13.5l-2.3-2.1a1.5 1.5 0 0 1 2.3-1.9 1.5 1.5 0 0 1 2.3 1.9z" fill="#fff"/>
          </svg>
        </span>
        <div>
          <h4>Share the words that touch your heart.</h4>
          <p>Save your favorite poems and share with someone who needs it.</p>
        </div>
      </div>
      <a class="join-btn" href="{{ auth()->check() ? route('member.dashboard') : route('register') }}">Join The Journey <span>&rarr;</span></a>
    </div>
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