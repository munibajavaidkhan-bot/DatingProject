<!-- Footer (shared) -->
<footer class="shared-footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <a class="brand" href="{{ url('/') }}">
          <svg viewBox="0 0 48 44" style="width:44px;height:40px">
            <path d="M24 40C10 30 2 20 2 12 2 5 8 1 14 1c4 0 8 2 10 6 2-4 6-6 10-6 6 0 12 4 12 11 0 8-8 18-22 28z"
              fill="none" stroke="url(#lg)" stroke-width="4"/>
          </svg>
          <span class="brand-text"><b>LOVE</b><i style="color:#b76cc9">PROJECT</i></span>
        </a>
        <p>52 Weeks to become the person you attract. Build better connections and find love that lasts.</p>
        <div class="socials">
          <a href="#" aria-label="Facebook"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M13 10h3l-.5 3H13v9h-3v-9H8v-3h2V8.5C10 6 11.5 4 14.5 4H17v3h-2c-1 0-2 .3-2 1.5V10z"/></svg></a>
          <a href="#" aria-label="Instagram"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.2" cy="6.8" r="1" fill="currentColor" stroke="none"/></svg></a>
          <a href="#" aria-label="Twitter"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M22 5.8c-.7.3-1.5.6-2.3.7.8-.5 1.4-1.3 1.7-2.2-.8.5-1.6.8-2.5 1A3.9 3.9 0 0 0 12 8.9 11 11 0 0 1 4 4.9a3.9 3.9 0 0 0 1.2 5.2c-.6 0-1.2-.2-1.7-.5v.1c0 1.9 1.3 3.5 3.1 3.8-.6.2-1.2.2-1.8.1.5 1.6 2 2.7 3.7 2.7A7.9 7.9 0 0 1 2 18.6a11.2 11.2 0 0 0 6 1.8c7.3 0 11.3-6 11.3-11.3v-.5c.8-.6 1.5-1.3 2-2.1z"/></svg></a>
          <a href="#" aria-label="YouTube"><svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12s0-3.3-.4-4.9c-.2-.9-.9-1.6-1.8-1.8C18.2 5 12 5 12 5s-6.2 0-7.8.3c-.9.2-1.6.9-1.8 1.8C2 8.7 2 12 2 12s0 3.3.4 4.9c.2.9.9 1.6 1.8 1.8C5.8 19 12 19 12 19s6.2 0 7.8-.3c.9-.2 1.6-.9 1.8-1.8.4-1.6.4-4.9.4-4.9z"/><path d="M10 9.5v5l4.5-2.5z" fill="#12122a"/></svg></a>
        </div>
      </div>

      <div class="f-links">
        <h5>Quick Links</h5>
        <a href="{{ url('/') }}">About Us</a><a href="{{ url('/#how-it-works') }}">How It Works</a><a href="{{ route('journey') }}">52 Weeks Journey</a>
        <a href="{{ route('articles.index') }}">Resources</a><a href="{{ route('pricing') }}">Pricing</a><a href="{{ route('member.blog') }}">Blog</a>
      </div>

      <div class="f-links">
        <h5>Resources</h5>
        <a href="{{ route('articles.index') }}" class="{{ ($active ?? '') === 'articles' ? 'active' : '' }}">Articles</a>
        <a href="{{ route('stories.index') }}" class="{{ ($active ?? '') === 'stories' ? 'active' : '' }}">Stories</a>
        <a href="{{ route('poems.index') }}" class="{{ ($active ?? '') === 'poems' ? 'active' : '' }}">Poems</a>
        <a href="{{ route('member.forum') }}">Community</a><a href="#">Guides</a>
      </div>

      <div>
        <h5>Newsletter</h5>
        <p style="font-size:13px;line-height:1.7;margin-bottom:16px">Get the best poems, stories and dating insights in your inbox.</p>
        <form class="news-form">
          <input type="email" placeholder="Your email">
          <button aria-label="Subscribe">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="#fff"><path d="M2 21l21-9L2 3v7l15 2-15 2z"/></svg>
          </button>
        </form>
      </div>
    </div>

    <div class="footer-bottom">
      <span>&copy; {{ date('Y') }} The Love Project. All rights reserved.</span>
      <nav><a href="{{ route('terms') }}">Terms</a><a href="{{ route('privacy') }}">Privacy</a><a href="#">Cookies</a></nav>
    </div>
  </div>
</footer>