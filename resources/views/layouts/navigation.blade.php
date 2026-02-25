
    <style>
        .text-shadow {
            text-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }
    </style>
    <nav x-data="{ open: false }" class="bg-gradient-to-r from-pink-500 to-purple-600 py-4 border-b border-pink-400">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <!-- Logo Section -->
            <div class="flex items-center gap-3">
                <a href="{{ url('/') }}" class="text-white font-extrabold text-xl tracking-wide">
                    <span class="text-shadow">THE LOVE PROJECT</span>
                </a>
            </div>

            <!-- Navigation Links - Desktop -->
            <div class="hidden sm:flex items-center gap-4">
                @auth
                    <!-- Role-based Navigation -->
                    <div class="flex items-center gap-3 text-white">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-white/30' : '' }}">
                                {{ __('Admin Panel') }}
                            </a>
                        @elseif(auth()->user()->isAuthor())
                            <a href="{{ route('author.dashboard') }}" class="px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors {{ request()->routeIs('author.dashboard') ? 'bg-white/30' : '' }}">
                                {{ __('Author Panel') }}
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors {{ request()->routeIs('user.dashboard') ? 'bg-white/30' : '' }}">
                                {{ __('User Panel') }}
                            </a>
                        @endif
                        
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors {{ request()->routeIs('dashboard') ? 'bg-white/30' : '' }}">
                            Home
                        </a>
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-full bg-white/20 hover:bg-white/30 transition-colors {{ request()->routeIs('profile.edit') ? 'bg-white/30' : '' }}">
                            Profile
                        </a>
                    </div>

                    <!-- User Dropdown -->
                    <div class="flex items-center gap-2">
                        <span class="text-white hidden sm:inline">Hi, {{ auth()->user()->name }}</span>
                        
                        <div class="relative" x-data="{ dropdownOpen: false }">
                            <button @click="dropdownOpen = !dropdownOpen" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-white bg-white/20 hover:bg-white/30 focus:outline-none transition ease-in-out duration-150">
                                <div class="flex items-center">
                                    <svg class="fill-current h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full bg-white text-pink-600 font-semibold hover:bg-gray-100 transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-white/30 text-white hover:bg-white/40 transition-colors">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-white/20 focus:outline-none focus:bg-white/20 focus:text-white transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden mt-4">
            <div class="pt-2 pb-3 space-y-1">
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : '' }}">
                            {{ __('Admin Panel') }}
                        </a>
                    @elseif(auth()->user()->isAuthor())
                        <a href="{{ route('author.dashboard') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md {{ request()->routeIs('author.dashboard') ? 'bg-white/20' : '' }}">
                            {{ __('Author Panel') }}
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md {{ request()->routeIs('user.dashboard') ? 'bg-white/20' : '' }}">
                            {{ __('User Panel') }}
                        </a>
                    @endif
                    
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md {{ request()->routeIs('dashboard') ? 'bg-white/20' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-white/20' : '' }}">
                        Profile
                    </a>
                @endauth
            </div>

            <!-- Mobile User Options -->
            @auth
                <div class="pt-4 pb-1 border-t border-pink-400">
                    <div class="px-4">
                        <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-pink-100">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md">
                            {{ __('Profile') }}
                        </a>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-white/20 rounded-md">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="pt-4 pb-1 border-t border-pink-400">
                    <div class="mt-3 space-y-1">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-white hover:bg-white/20 rounded-md">
                            Register
                        </a>
                    </div>
                </div>
            @endauth
        </div>
    </nav>
