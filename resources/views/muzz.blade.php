{{-- resources/views/welcome.blade.php --}}
@extends('layouts.guest-layout') 

@section('title', 'The Love Project | 52 Weeks to Forever')

@section('content')

{{-- Hero Section (Clean, Bold, Muzz-like Centered Focus) --}}
<section class="relative overflow-hidden min-h-[85vh] flex flex-col justify-center pt-24 pb-20">
    {{-- Custom Pink/Purple Gradient Background (Your Brand Theme) --}}
    <div class="absolute inset-0" aria-hidden="true" style="background: linear-gradient(180deg, #5B21B6 0%, #C026D3 40%, #DB2777 70%, #F43F5E 100%); filter: saturate(1.1) brightness(1.1);"></div>
    {{-- Subtle sparkle/noise overlay --}}
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'100%25\' height=\'100%25\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.65\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3CfeColorMatrix type=\'saturate\' values=\'0\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\' opacity=\'0.05\'/%3E%3C/svg%3E')]"></div>
    
    {{-- Decorative faint photo overlay (Subtly blended for depth) --}}
    <div class="absolute inset-0 opacity-15 mix-blend-multiply">
        <img src="{{ asset('images/hero-soft.jpeg') }}" alt="hero" class="w-full h-full object-cover">
    </div>

    {{-- Floating hearts (for a romantic touch) --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="heart h-6 w-6 left-8 top-16 animation-slow"></div>
        <div class="heart h-8 w-8 right-12 top-24"></div>
        <div class="heart h-5 w-5 left-1/3 bottom-1/4 animation-slower"></div>
        <div class="heart h-7 w-7 right-1/4 top-1/2 animation-slow"></div>
        <div class="heart h-4 w-4 left-1/4 top-1/2 animation-slower"></div>
    </div>

    {{-- Fixed Navbar (Muzz-like: clean logo/login) --}}
    <div id="main-navbar" class="fixed top-0 left-0 w-full z-50 px-6 py-4 transition duration-300 bg-transparent"> 
        <nav class="max-w-7xl mx-auto flex items-center justify-between transition-all">
            <div class="flex items-center gap-3">
                <div class="rounded-full bg-white/20 w-10 h-10 flex items-center justify-center transition duration-300" id="brand-icon">
                    <svg class="w-6 h-6 text-white transition duration-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-4.978-8-11a5 5 0 0110 0 5 5 0 0110 0c0 6.022-8 11-8 11z"/></svg>
                </div>
                <span class="text-white font-extrabold text-xl tracking-wider transition duration-300" id="brand-text">The Love Project</span>
            </div>

            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-white/90 hover:underline font-semibold transition duration-300 nav-link">Log In</a>
                <a href="{{ route('register') }}" class="inline-block px-5 py-2.5 rounded-full bg-white text-purple-600 font-bold shadow-lg transform hover:scale-105 transition duration-300">Join Free</a>
            </div>
        </nav>
    </div>

    {{-- Hero Content (Centered, Direct Message) --}}
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center flex flex-col items-center justify-center flex-grow"> 
        <h1 class="text-6xl md:text-8xl font-extrabold leading-none text-white drop-shadow-lg animate-fade-in-up">
            Ready for <span class="text-pink-300">Forever</span>? <span class="block mt-4 text-4xl md:text-6xl font-medium opacity-90">52 Weeks to Meaningful Love.</span>
        </h1>
        <p class="mt-8 text-white/90 text-xl md:text-2xl max-w-3xl animate-fade-in-up delay-200">
            Dating designed for commitment. No swiping games, just real growth and curated matches.
        </p>

        <div class="mt-12">
            <a href="{{ route('register') }}" class="inline-flex items-center gap-3 px-10 py-5 text-xl rounded-full bg-white text-purple-600 font-bold shadow-xl transform hover:bg-gray-100 hover:scale-105 transition duration-300 animate-fade-in-up delay-400">
                Start Your Journey
            </a>
        </div>
    </div>
</section>
<hr class="border-t border-gray-100">

{{-- Muzz-Inspired Features/Trust Blocks (White background for clarity) --}}
<section id="how" class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-4">The Project Difference: Commitment Meets Quality</h2>
        <p class="text-lg text-gray-600 max-w-xl mx-auto mb-16">
            We focus on structure, trust, and personality science to build lasting relationships.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Card 1: 52 Weeks Structure --}}
            <div class="relative flex flex-col items-center p-8 bg-white border-b-4 border-pink-500 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="w-20 h-20 mb-6 flex items-center justify-center bg-pink-50 rounded-full text-pink-600">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">52 Weeks of Growth</h3>
                <p class="text-gray-600 text-base">Structured content ensures you and your match are always learning and growing together.</p>
            </div>

            {{-- Card 2: Personality Matching --}}
            <div class="relative flex flex-col items-center p-8 bg-white border-b-4 border-purple-500 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="w-20 h-20 mb-6 flex items-center justify-center bg-purple-50 rounded-full text-purple-600">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Curated Connections</h3>
                <p class="text-gray-600 text-base">We go beyond looks, matching you based on compatibility quizzes and shared life goals.</p>
            </div>

            {{-- Card 3: Trust and Safety (Muzz focus) --}}
            <div class="relative flex flex-col items-center p-8 bg-white border-b-4 border-pink-500 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                <div class="w-20 h-20 mb-6 flex items-center justify-center bg-pink-50 rounded-full text-pink-600">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-1 14h2v2h-2v-2zm0-8h2v6h-2V7z"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Verified & Safe</h3>
                <p class="text-gray-600 text-base">Robust safety features and profile verification ensure a trustworthy, respectful community.</p>
            </div>
        </div>
    </div>
</section>
<hr class="border-t border-gray-100">

{{-- Statistics Block (Muzz often highlights numbers/success) --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-extrabold text-gray-800 mb-12">The Numbers Behind Meaningful Love</h2>
        <div class="grid grid-cols-3 gap-8">
            <div>
                <div class="text-5xl font-extrabold text-purple-600">52</div>
                <div class="text-gray-500 font-medium mt-2">Lessons Completed</div>
            </div>
            <div>
                <div class="text-5xl font-extrabold text-pink-600">98k+</div>
                <div class="text-gray-500 font-medium mt-2">Members Joined</div>
            </div>
            <div>
                <div class="text-5xl font-extrabold text-purple-600">4x</div>
                <div class="text-gray-500 font-medium mt-2">Higher Success Rate*</div>
            </div>
        </div>
        <p class="text-xs text-gray-400 mt-10">*Compared to standard swiping apps in our study.</p>
    </div>
</section>
<hr class="border-t border-gray-100">

{{-- Call to Action Section (Simplified, Muzz-like) --}}
<section class="py-16 bg-gradient-to-r from-pink-600 to-purple-700 text-white text-center">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-extrabold mb-4">Start Your Growth Journey Today</h2>
        <p class="text-xl font-medium opacity-90 max-w-2xl mx-auto mb-8">
            Take the personality quiz and find your meaningful match.
        </p>
        <a href="{{ route('register') }}" class="inline-block px-10 py-4 text-lg rounded-full bg-white text-purple-700 font-bold shadow-2xl transform hover:scale-105 transition duration-300">
            Sign Up Now - It's Free
        </a>
    </div>
</section>
<hr class="border-t border-gray-100">

{{-- Footer (Standard) --}}
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-5 gap-8">
        <div class="md:col-span-2">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-9 h-9 rounded-full bg-pink-500 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21s-8-4.978-8-11a5 5 0 0110 0 5 5 0 0110 0c0 6.022-8 11-8 11z"/></svg>
                </div>
                <span class="font-extrabold text-xl">The Love Project</span>
            </div>
            <p class="text-gray-400 text-sm max-w-xs">52 Weeks to Forever — lessons, quizzes & curated matches for meaningful, long-lasting love.</p>
        </div>

        <div>
            <h5 class="font-bold mb-3">Product</h5>
            <ul class="text-gray-400 text-sm space-y-2">
                <li><a href="#how" class="hover:text-white transition">How it works</a></li>
                <li><a href="#features" class="hover:text-white transition">Features</a></li>
                <li><a href="#" class="hover:text-white transition">Blog</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-bold mb-3">Company</h5>
            <ul class="text-gray-400 text-sm space-y-2">
                <li><a href="#" class="hover:text-white transition">About Us</a></li>
                <li><a href="#" class="hover:text-white transition">Contact</a></li>
                <li><a href="#" class="hover:text-white transition">Careers</a></li>
            </ul>
        </div>

        <div>
            <h5 class="font-bold mb-3">Legal</h5>
            <ul class="text-gray-400 text-sm space-y-2">
                <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
            </ul>
        </div>
    </div>

    <div class="mt-12 text-center text-gray-500 text-xs">
        © 2025 The Love Project. All rights reserved.
    </div>
</footer>

<style>
    /* floating hearts (decorative) */
    .heart { position:absolute; background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.12), rgba(255,255,255,0.02)); border-radius: 50%; transform: translateY(0); }
    .heart::after, .heart::before { content:''; position:absolute; width:60%; height:60%; background:inherit; border-radius:50%; top:-25%; left:20%; }
    .animation-slow { animation: floaty 9s ease-in-out infinite; opacity:0.65; }
    .animation-slower { animation: floaty 12s ease-in-out infinite; opacity:0.5; }
    @keyframes floaty { 0%{ transform:translateY(0) } 50%{ transform:translateY(-18px) } 100%{ transform:translateY(0) } }

    /* Keyframe animations for fade-in effect */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
        opacity: 0; /* Start hidden */
    }
    .delay-200 { animation-delay: 0.2s; }
    .delay-400 { animation-delay: 0.4s; }
</style>

<script>
    (function(){
        const navbar = document.getElementById('main-navbar');
        const brandText = document.getElementById('brand-text');
        const brandIcon = document.getElementById('brand-icon');
        const navLinks = navbar.querySelectorAll('.nav-link'); 

        function updateNavbar() {
            if (window.scrollY > 100) {
                // Scroll Down: Solid White Background, Dark Links
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-white', 'shadow-lg');

                brandText.classList.remove('text-white');
                brandText.classList.add('text-purple-600'); 
                
                brandIcon.classList.remove('bg-white/20');
                brandIcon.classList.add('bg-purple-500'); // Solid purple for icon background

                navLinks.forEach(link => {
                    link.classList.remove('text-white/90');
                    link.classList.add('text-gray-700');
                });
            } else {
                // Top of Page: Transparent Background, White Links
                navbar.classList.remove('bg-white', 'shadow-lg');
                navbar.classList.add('bg-transparent');

                brandText.classList.remove('text-purple-600');
                brandText.classList.add('text-white'); 
                
                brandIcon.classList.remove('bg-purple-500'); // Transparent white for icon background
                brandIcon.classList.add('bg-white/20');

                navLinks.forEach(link => {
                    link.classList.remove('text-gray-700');
                    link.classList.add('text-white/90');
                });
            }
        }

        // Add event listeners
        window.addEventListener('scroll', updateNavbar);
        updateNavbar(); // Run once on load
    })();
</script>

@endsection