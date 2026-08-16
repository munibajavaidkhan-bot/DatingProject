<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>The Love Project — Dating & Relationship Insights</title>

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
<section class="hero">
  <img class="hero-img" src="{{ asset('images/hero-couple.jpg') }}" alt="Couple sharing a sunset moment">
  <span class="hero-tint"></span>
  <div class="container">
    <div class="hero-inner">
      <span class="eyebrow">Quick Reads</span>
      <h1>Dating &amp; Relationship <span>Insights</span></h1>
      <p>Short articles to help you understand modern dating, build better connections and choose with clarity.</p>
      <form class="search" action="{{ route('articles.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}">
        <button aria-label="Search">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.4">
            <circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</section>

<!-- FILTERS + GRID -->
<section class="container">

  <div class="filter-bar reveal">
    <div class="pills">
      <button class="filter-pill active" data-filter="all">All</button>
      @foreach(['dating'=>'Dating Advice','relationships'=>'Relationships','self-love'=>'Self Love','boundaries'=>'Boundaries','communication'=>'Communication','mindset'=>'Mindset'] as $key => $label)
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

  <div class="articles" id="articles">
    @forelse($articles as $i => $article)
    <article class="article-card reveal" data-cat="{{ $article->categoryRel?->slug ?: 'all' }}" data-date="{{ $article->published_at?->timestamp ?? 0 }}" data-views="{{ $article->views }}">
      <div class="thumb">
        @if($i % 2 === 0)
        <span class="badge">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ee2c7a" stroke-width="2"><path d="M14 2H7a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7z"/><path d="M14 2v5h5"/><path d="M9 13h6M9 17h4"/></svg>
        </span>
        @endif
        @if($article->cover_image)
        <img src="{{ asset('images/' . $article->cover_image) }}" alt="{{ $article->title }}">
        @endif
      </div>
      <div class="a-body">
        <span class="cat">{{ $article->categoryRel?->name ?? 'Advice' }}</span>
        <h3><a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a></h3>
        <p>{{ $article->excerpt }}</p>
        <div class="meta">
          <span class="read-time"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>{{ $article->read_minutes }} min read</span>
          <a class="read-more" href="{{ route('articles.show', $article->slug) }}">Read More <span>&rarr;</span></a>
        </div>
      </div>
    </article>
    @empty
    <div class="grid-empty" style="grid-column:1/-1">
      <h3>No articles found</h3>
      <p>Is category me abhi koi article nahi hai &mdash; jald hi add honge. &#128151;</p>
    </div>
    @endforelse
  </div>
  <p class="empty" id="empty">Is category me abhi koi article nahi hai &mdash; jald hi add honge. &#128151;</p>

  @if($articles->hasPages())
  <nav class="pagination">
    @if($articles->onFirstPage())
      <span class="disabled">&larr;</span>
    @else
      <a href="{{ $articles->previousPageUrl() }}">&larr;</a>
    @endif
    @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
      <a href="{{ $url }}" class="{{ $page === $articles->currentPage() ? 'active' : '' }}">{{ $page }}</a>
    @endforeach
    @if($articles->hasMorePages())
      <a href="{{ $articles->nextPageUrl() }}">&rarr;</a>
    @else
      <span class="disabled">&rarr;</span>
    @endif
  </nav>
  @endif

  <!-- CTA -->
  <div class="cta reveal">
    <span class="cta-icon">
      <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
        <path d="M12 6C10 4.2 7 4 4 4v14c3 0 6 .2 8 2 2-1.8 5-2 8-2V4c-3 0-6 .2-8 2z" stroke="#23233d" stroke-width="1.8"/>
        <path d="M12 13.6l-2.4-2.2a1.6 1.6 0 0 1 2.4-2 1.6 1.6 0 0 1 2.4 2z" fill="#ee2c7a"/>
      </svg>
    </span>
    <div>
      <h3>Want to go <em>deeper?</em></h3>
      <p>Explore our long stories for real conversations that make you feel &amp; think.</p>
    </div>
    <a class="cta-btn" href="{{ route('stories.index') }}">Explore Long Stories <span>&rarr;</span></a>
    <svg class="cta-heart ch1"><use href="#heart-o"/></svg>
    <svg class="cta-heart ch2"><use href="#heart-o"/></svg>
    <svg class="cta-heart ch3"><use href="#heart-o"/></svg>
  </div>
</section>

<!-- FOOTER -->
@include('partials.site-footer', ['active' => 'articles'])

<script>
/* Scroll reveal */
const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('in');io.unobserve(e.target);}}),{threshold:.1});
document.querySelectorAll('.reveal').forEach(el=>io.observe(el));

/* Category filtering */
const pills=document.querySelectorAll('.filter-pill'),
      cards=document.querySelectorAll('.article-card'),
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
  const grid=document.getElementById('articles');
  sorted.forEach(c=>grid.appendChild(c));
}));
</script>
</body>
</html>