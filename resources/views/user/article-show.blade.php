<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>{{ $article->title }} — The Love Project</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/articles.css">
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="heart-o" viewBox="0 0 24 24">
    <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"
      fill="none" stroke="currentColor" stroke-width="1.8"/>
  </symbol>
</svg>

<!-- HEADER -->
@include('partials.site-header', ['active' => 'articles'])

<!-- HERO -->
<section class="hero hero-sub">
  <img class="hero-img" src="{{ asset('images/hero-couple.jpg') }}" alt="Couple sharing a sunset moment">
  <span class="hero-tint"></span>
  <div class="container">
    <div class="hero-inner">
      <span class="eyebrow">{{ $article->categoryRel?->name ?? 'Quick Reads' }}</span>
      <h1>{{ $article->title }}</h1>
    </div>
  </div>
</section>

<!-- ARTICLE DETAIL -->
<section class="container">
  <article class="article-detail reveal">
    @if($article->cover_image)
    <img class="article-cover" src="{{ asset('images/' . $article->cover_image) }}" alt="{{ $article->title }}">
    @endif

    <div class="article-meta">
      @if($article->author)
      <span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
          <circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6"/>
        </svg>
        {{ $article->author->name }}
      </span>
      @endif
      @if($article->published_at)
      <span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
          <rect x="3" y="5" width="18" height="16" rx="3"/><path d="M3 10h18M8 3v4M16 3v4"/>
        </svg>
        {{ $article->published_at->format('M d, Y') }}
      </span>
      @endif
      <span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
          <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>
        </svg>
        {{ $article->read_minutes }} min read
      </span>
      <span>
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2">
          <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"/><circle cx="12" cy="12" r="3"/>
        </svg>
        {{ $article->views }} views
      </span>
    </div>

    <div class="article-body">
      {!! nl2br(e($article->body)) !!}
    </div>

    <div class="article-back">
      <a class="back-link" href="{{ route('articles.index') }}">
        <span>&larr;</span> Back To Articles
      </a>
    </div>
  </article>

  @if($related->count())
  <div class="related reveal">
    <h2>More Articles You'll Love</h2>
    <div class="articles">
      @foreach($related as $r)
      <article class="article-card reveal">
        <div class="thumb">
          @if($r->cover_image)
          <img src="{{ asset('images/' . $r->cover_image) }}" alt="{{ $r->title }}">
          @endif
        </div>
        <div class="a-body">
          <span class="cat">{{ $r->categoryRel?->name ?? 'Advice' }}</span>
          <h3><a href="{{ route('articles.show', $r->slug) }}">{{ $r->title }}</a></h3>
          <p>{{ $r->excerpt }}</p>
          <div class="meta">
            <span class="read-time"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $r->read_minutes }} min read</span>
            <a class="read-more" href="{{ route('articles.show', $r->slug) }}">Read More <span>&rarr;</span></a>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
  @endif
</section>

<!-- FOOTER -->
@include('partials.site-footer', ['active' => 'articles'])

<script>
const io=new IntersectionObserver(entries=>{
  entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('in'); io.unobserve(e.target); } });
},{threshold:.12});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>
</body>
</html>