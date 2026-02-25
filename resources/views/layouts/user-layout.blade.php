<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title','The Love Project')</title>

  <!-- Fonts (Instrument Sans like reference) -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="text-gray-900 font-sans">
   <nav x-data="{ open: false }" class="text-gray-600 body-font shadow-sm bg-white">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between py-4">
            <!-- Logo Section -->
            <div class="flex items-center gap-3">
                 <a class="flex title-font font-medium items-center text-gray-900 mb-0" href="{{ url('/') }}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-10 h-10 text-white p-2 bg-pink-500 rounded-full" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <span class="ml-3 text-xl text-pink-600 font-bold">The Love Project</span>
            </a>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <!-- Role-based Navigation -->
                    <div class="flex items-center gap-3">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full bg-pink-100 text-pink-700 hover:bg-pink-200 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-pink-200' : '' }}">
                                {{ __('Admin Panel') }}
                            </a>
                        @elseif(auth()->user()->isAuthor())
                            <a href="{{ route('author.dashboard') }}" class="px-4 py-2 rounded-full bg-pink-100 text-pink-700 hover:bg-pink-200 transition-colors {{ request()->routeIs('author.dashboard') ? 'bg-pink-200' : '' }}">
                                {{ __('Author Panel') }}
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 rounded-full bg-pink-100 text-pink-700 hover:bg-pink-200 transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-pink-200' : '' }}">
                                {{ __('User Panel') }}
                            </a>
                        @endif
                        
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-white/0 text-gray-900 hover:text-pink-600 transition-colors {{ request()->routeIs('dashboard') ? 'text-pink-600' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-full bg-white/0 text-gray-900 hover:text-pink-600 transition-colors {{ request()->routeIs('profile.edit') ? 'text-pink-600' : '' }}">
                            Profile
                        </a>
                    </div>

                    <!-- User Dropdown -->
                    <div class="flex items-center gap-2">
                        <span class="text-gray-700 hidden sm:inline">Hi, {{ auth()->user()->name }}</span>
                        
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-full text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center">
                                    <svg class="h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        {{ __('Profile') }}
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ __('Log Out') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Guest Navigation -->
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-gray-100 text-gray-800 font-medium hover:bg-gray-200 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-pink-500 text-white font-medium hover:bg-pink-600 transition-colors">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden mt-2">
            <div class="pt-2 pb-3 space-y-1">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                            {{ __('Admin Panel') }}
                        </a>
                    @elseif(auth()->user()->isAuthor())
                        <a href="{{ route('author.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('author.dashboard') ? 'bg-gray-100' : '' }}">
                            {{ __('Author Panel') }}
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('user.dashboard') ? 'bg-gray-100' : '' }}">
                            {{ __('User Panel') }}
                        </a>
                    @endif
                    
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('dashboard') ? 'bg-gray-100' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-gray-100' : '' }}">
                        Profile
                    </a>
                @endauth
            </div>

            <!-- Mobile User Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md">
                            {{ __('Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 rounded-md">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-white bg-pink-500 hover:bg-pink-600 rounded-md text-center">
                            Register
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </nav>

  <main class="py-8">
    <div class="max-w-7xl mx-auto px-4">
      @yield('content')
    </div>
  </main>

  <footer class="bg-gray-800 text-white py-8 mt-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
      <div class="flex items-center justify-center gap-3 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
          <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
        </svg>
        <span class="text-xl font-bold">The Love Project</span>
      </div>
      <div class="text-sm text-gray-300">© {{ date('Y') }} The Love Project — 52 Weeks to Forever</div>
    </div>
  </footer>

</body>
</html>
