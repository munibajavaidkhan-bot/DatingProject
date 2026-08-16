<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>The Love Project — Stories That Make You Feel & Think</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,600&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/stories.css">
</head>
<body>

<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="heart-o" viewBox="0 0 24 24">
    <path d="M12 20.5C7.2 16.3 3 12.8 3 8.9 3 6.2 5.1 4 7.8 4c1.7 0 3.2.8 4.2 2.2C13 4.8 14.5 4 16.2 4 18.9 4 21 6.2 21 8.9c0 3.9-4.2 7.4-9 11.6z"
      fill="none" stroke="currentColor" stroke-width="1.8"/>
  </symbol>
</svg>

<!-- HEADER -->
@include('partials.site-header', ['active' => 'stories'])

<!-- HERO -->
<section class="hero">
  <img class="hero-img" src="{{ asset('images/hero-stories.jpg') }}" alt="Woman watching sunset over the city">
  <div class="container">
    <div class="hero-inner">
      <span class="eyebrow">Deep Reads</span>
      <h1>Stories That Make You <span>Feel &amp; Think</span></h1>
      <p>Long-form stories about love, dating, relationships and becoming your best self.</p>
      <form class="search" action="{{ route('stories.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search stories..." value="{{ request('search') }}">
        <button aria-label="Search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.4">
            <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</section>

<!-- FEATURED STORY -->
@if($featured)
<div class="container featured-wrap">
  <article class="featured-card reveal">
    <div class="f-img">
      @if($featured->cover_image)
      <img src="{{ asset('images/' . $featured->cover_image) }}" alt="{{ $featured->title }}">
      @endif
    </div>
    <button class="bookmark" aria-label="Save story">
      <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/></svg>
    </button>
    <div class="f-body">
      <span class="f-label">Featured Story</span>
      <h2>{{ $featured->title }}</h2>
      <p>{{ $featured->excerpt }}</p>
      <div class="f-meta">
        <span class="read-time"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $featured->read_minutes }} min read</span>
        <a class="read-full" href="{{ route('stories.show', $featured->slug) }}">Read Full Story <span>&rarr;</span></a>
      </div>
    </div>
  </article>
</div>
@endif

<!-- ALL STORIES -->
<section class="container">

  <div class="stories-bar reveal">
    <h2>All Stories</h2>
    <div class="pills">
      <button class="filter-pill active" data-filter="all">All</button>
      @foreach(['dating'=>'Dating','relationships'=>'Relationships','self-love'=>'Self Love','mindset'=>'Mindset'] as $key => $label)
      <button class="filter-pill" data-filter="{{ $key }}">{{ $label }}</button>
      @endforeach
    </div>
    <div class="sort" id="sort">
      <button class="sort-btn"><span>Most Recent</span>
        <svg width="11" height="7" viewBox="0 0 11 7" fill="none"><path d="M1 1l4.5 4.5L10 1" stroke="#23233d" stroke-width="1.6" stroke-linecap="round"/></svg>
      </button>
      <div class="sort-menu">
        <a href="#" data-sort="recent">Most Recent</a><a href="#" data-sort="oldest">Oldest First</a><a href="#" data-sort="popular">Most Popular</a>
      </div>
    </div>
  </div>

  <div class="story-grid" id="stories">
    @forelse($stories as $story)
    <article class="story-card reveal" data-cat="{{ $story->categoryRel?->slug ?: 'all' }}" data-date="{{ $story->published_at?->timestamp ?? 0 }}" data-views="{{ $story->views }}">
      <div class="s-thumb">
        @if($story->cover_image)
        <img src="{{ asset('images/' . $story->cover_image) }}" alt="{{ $story->title }}">
        @endif
      </div>
      <div class="s-body">
        <span class="cat">{{ $story->categoryRel?->name ?? 'Stories' }}</span>
        <h3><a href="{{ route('stories.show', $story->slug) }}">{{ $story->title }}</a></h3>
        <div class="s-meta">
          <span class="read-time"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $story->read_minutes }} min read</span>
          <a class="read-story" href="{{ route('stories.show', $story->slug) }}">Read Story <span>&rarr;</span></a>
        </div>
      </div>
    </article>
    @empty
    <div class="grid-empty" style="grid-column:1/-1">
      <h3>No stories found</h3>
      <p>Is category me abhi koi story nahi hai &mdash; jald hi add hogi. &#128151;</p>
    </div>
    @endforelse
  </div>
  <p class="empty" id="empty">Is category me abhi koi story nahi hai &mdash; jald hi add hogi. &#128151;</p>

  @if($stories->hasPages())
  <nav class="pagination">
    @if($stories->onFirstPage())
      <span class="disabled">&larr;</span>
    @else
      <a href="{{ $stories->previousPageUrl() }}">&larr;</a>
    @endif
    @foreach($stories->getUrlRange(1, $stories->lastPage()) as $page => $url)
      <a href="{{ $url }}" class="{{ $page === $stories->currentPage() ? 'active' : '' }}">{{ $page }}</a>
    @endforeach
    @if($stories->hasMorePages())
      <a href="{{ $stories->nextPageUrl() }}">&rarr;</a>
    @else
      <span class="disabled">&rarr;</span>
    @endif
  </nav>
  @endif

  <div class="explore-wrap reveal">
    <a class="explore-btn" href="{{ route('stories.index') }}">Explore More Stories <span>&rarr;</span></a>
  </div>

  <!-- NEWSLETTER CTA -->
  <div class="cta reveal">
    <span class="cta-icon">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
        <rect x="3" y="5" width="18" height="14" rx="3" stroke="#ee2c7a" stroke-width="1.8"/>
        <path d="M12 13.4l-2.2-2a1.5 1.5 0 0 1 2.2-1.9 1.5 1.5 0 0 1 2.2 1.9z" fill="#ee2c7a"/>
        <path d="M3.5 7l8.5 6 8.5-6" stroke="#ee2c7a" stroke-width="1.8"/>
      </svg>
    </span>
    <div>
      <h3>Love Better. Choose Wisely.</h3>
      <p>Get weekly stories and insights to help you build healthier connections and a better you.</p>
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
@include('partials.site-footer', ['active' => 'stories'])

<script>
/* Scroll reveal */
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}}),{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

/* Category filtering */
const pills=document.querySelectorAll('.filter-pill'),
      cards=document.querySelectorAll('.story-card'),
      empty=document.getElementById('empty');
pills.forEach(p=>p.addEventListener('click',()=>{
  pills.forEach(x=>x.classList.remove('active'));p.classList.add('active');
  const f=p.dataset.filter;let n=0;
  cards.forEach(c=>{const show=(f==='all'||c.dataset.cat===f);c.style.display=show?'':'none';if(show)n++;});
  empty.classList.toggle('show',n===0);
}));

/* Sort dropdown */
const sort=document.getElementById('sort');
sort.querySelector('.sort-btn').addEventListener('click',e=>{e.stopPropagation();sort.classList.toggle('open');});
document.addEventListener('click',()=>sort.classList.remove('open'));
sort.querySelectorAll('.sort-menu a').forEach(a=>a.addEventListener('click',e=>{
  e.preventDefault();const mode=a.dataset.sort;
  sort.querySelector('.sort-btn span').textContent=a.textContent;sort.classList.remove('open');
  const sorted=Array.from(cards);
  sorted.sort((x,y)=>{
    if(mode==='oldest')return x.dataset.date-y.dataset.date;
    if(mode==='popular')return y.dataset.views-x.dataset.views;
    return y.dataset.date-x.dataset.date;
  });
  const grid=document.getElementById('stories');
  sorted.forEach(c=>grid.appendChild(c));
}));
</script>
</body>
</html>