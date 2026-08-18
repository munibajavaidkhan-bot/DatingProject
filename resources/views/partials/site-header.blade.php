<!-- Header (shared) -->
<header class="site-header">
  <a class="brand" href="{{ url('/') }}">
    <svg viewBox="0 0 48 44">
      <defs><linearGradient id="lg" x1="0" y1="0" x2="1" y2="1">
        <stop offset="0" stop-color="#8a2fc0"/><stop offset="1" stop-color="#f72f8e"/>
      </linearGradient></defs>
      <path d="M24 40C10 30 2 20 2 12 2 5 8 1 14 1c4 0 8 2 10 6 2-4 6-6 10-6 6 0 12 4 12 11 0 8-8 18-22 28z"
        fill="none" stroke="url(#lg)" stroke-width="4"/>
    </svg>
    <span class="brand-text"><b>LOVE</b><i>PROJECT</i></span>
  </a>

  <nav class="main-nav">
    <a href="{{ url('/') }}" class="{{ ($active ?? '') === 'home' ? 'active' : '' }}">Home</a>
    <a href="{{ url('/#how-it-works') }}">How It Works</a>
    <a href="{{ route('journey') }}">52 Weeks</a>
    @php
        $siteAuthor = \App\Models\User::where('role', 'author')->first();
    @endphp
    @if($siteAuthor)
    <a href="{{ route('author.page', \Illuminate\Support\Str::slug($siteAuthor->name)) }}" class="{{ ($active ?? '') === 'author' ? 'active' : '' }}">Author</a>
    @endif
    @if(($active ?? '') === 'articles')
    <a href="{{ route('articles.index') }}" class="active">Articles</a>
    @elseif(($active ?? '') === 'stories')
    <a href="{{ route('stories.index') }}" class="active">Stories</a>
    @else
    <a href="{{ route('poems.index') }}" class="{{ ($active ?? '') === 'poems' ? 'active' : '' }}">Poems</a>
    @endif
    <div class="drop">
      <a href="{{ route('articles.index') }}">Resources
        <svg width="11" height="7" viewBox="0 0 11 7" fill="none"><path d="M1 1l4.5 4.5L10 1" stroke="#23233d" stroke-width="1.6" stroke-linecap="round"/></svg>
      </a>
      <div class="drop-menu">
        <a href="{{ route('articles.index') }}" class="{{ ($active ?? '') === 'articles' ? 'active' : '' }}">Articles</a>
        <a href="{{ route('stories.index') }}" class="{{ ($active ?? '') === 'stories' ? 'active' : '' }}">Stories</a>
        <a href="{{ route('poems.index') }}" class="{{ ($active ?? '') === 'poems' ? 'active' : '' }}">Poems</a>
        <a href="{{ route('member.forum') }}">Community</a><a href="#">Guides</a>
      </div>
    </div>
    <a href="{{ route('pricing') }}">Pricing</a>
  </nav>

  <a class="account-btn" href="{{ auth()->check() ? route('member.dashboard') : route('login') }}">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2">
      <circle cx="12" cy="8" r="4"/><path d="M4 21c1.5-4 5-6 8-6s6.5 2 8 6"/>
    </svg>
    {{ auth()->check() ? 'My Account' : 'Sign In' }}
  </a>
</header>