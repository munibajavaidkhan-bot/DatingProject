<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','The Love Project')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Custom Love Project Styles */
      .heart { position:absolute; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.12), rgba(255,255,255,0.02)); border-radius: 50%; transform: translateY(0); }
      .heart::after, .heart::before { content:''; position:absolute; width:60%; height:60%; background:inherit; border-radius:50%; top:-25%; left:20%; }
      .animation-slow { animation: floaty 9s ease-in-out infinite; opacity:0.65; }
      .animation-slower { animation: floaty 12s ease-in-out infinite; opacity:0.5; }
      @keyframes floaty { 0%{ transform:translateY(0) } 50%{ transform:translateY(-18px) } 100%{ transform:translateY(0) } }
    </style>
  </head>
  <body class="antialiased bg-gradient-to-br from-pink-50 via-purple-50 to-pink-50 min-h-screen @if(request()->is('login') || request()->is('register'))flex items-center justify-center @endif">
    @yield('content')
  </body>
</html>
