@extends('layouts.user-layout')
@section('title', 'Love Compatibility Quiz')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0 min-h-screen">
    <div class="min-h-screen bg-gradient-to-br from-pink-100 via-rose-100 to-pink-100 relative overflow-hidden">
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-10 w-96 h-96 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-pulse"></div>
        <div class="absolute top-40 right-10 w-[500px] h-[500px] bg-rose-200 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-pulse animation-delay-2000"></div>
        <div class="absolute bottom-20 left-1/2 w-[400px] h-[400px] bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-50 animate-pulse animation-delay-4000"></div>
        <div class="absolute top-1/3 left-1/4 w-80 h-80 bg-rose-300 rounded-full mix-blend-multiply filter blur-xl opacity-40 animate-pulse animation-delay-1000"></div>
        <div class="absolute bottom-1/3 right-1/4 w-72 h-72 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-45 animate-pulse animation-delay-3000"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 w-full px-6 py-12">
        
        <!-- Hero Section -->
        <div class="text-center mb-16 animate-fade-in-up">
            <div class="inline-block mb-6">
                <div class="bg-white/80 backdrop-blur-sm rounded-full px-6 py-3 shadow-lg border border-pink-100">
                    <span class="text-pink-600 font-semibold text-sm uppercase tracking-wider">✨ The Love Project ✨</span>
                </div>
            </div>
            <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 mb-6 leading-tight animate-slide-in-down">
                Find someone who matches your
                <span class="bg-gradient-to-r from-pink-500 to-rose-500 bg-clip-text text-transparent">vibe</span>,
                <br>not just your photos.
            </h1>
            <p class="text-xl lg:text-2xl text-gray-700 max-w-6xl mx-auto leading-relaxed animate-fade-in-up animation-delay-200">
                Ready to move beyond chaotic dating and step into compatibility-driven connections? 
                <br class="hidden lg:block">
                Start exploring your personality and discover who you truly connect with.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-20 animate-fade-in-up animation-delay-400">
            <a href="{{ route('quiz.show', 1) }}" 
               class="group relative px-10 py-5 bg-gradient-to-r from-pink-500 to-rose-500 text-white font-bold rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 text-lg overflow-hidden">
                <span class="relative z-10 flex items-center gap-3">
                    Take Quiz
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-rose-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
            </a>
            <a href="#" class="group relative px-10 py-5 bg-white text-pink-600 font-bold rounded-full shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg border-2 border-pink-200 hover:border-pink-400">
                <span class="flex items-center gap-3">
                    Discover Style
                    <svg class="w-5 h-5 transform group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </span>
            </a>
            <a href="{{ route('user.matches') }}" class="group relative px-10 py-5 bg-gradient-to-r from-pink-400 to-rose-400 text-white font-bold rounded-full shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 text-lg">
                <span class="flex items-center gap-3">
                    Meet Matches
                    <svg class="w-5 h-5 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </span>
            </a>
        </div>

        <!-- Progress Section -->
        @if($completedQuestions > 0)
        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-xl p-8 mb-16 animate-fade-in-up animation-delay-600">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Your Progress</h3>
                <div class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full font-semibold">
                    {{ $progress }}% Complete
                </div>
            </div>
            <div class="mb-6">
                <div class="flex justify-between text-sm text-gray-600 mb-3">
                    <span>{{ $completedQuestions }} of {{ $totalQuestions }} questions completed</span>
                    <span class="font-medium">{{ $totalQuestions - $completedQuestions }} remaining</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-6 shadow-inner overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-pink-500 via-pink-600 to-rose-500 shadow-md transition-all duration-1000 ease-out relative overflow-hidden" 
                         style="width: {{ $progress }}%">
                        <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('quiz.show', $completedQuestions + 1) }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-600 to-rose-600 text-white font-bold rounded-full hover:from-pink-700 hover:to-rose-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    Continue Quiz
                    <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>
        @endif

        <!-- Journey Selection -->
        <div class="mb-20 animate-fade-in-up animation-delay-800">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Choose Your Journey</h2>
                <p class="text-xl text-gray-600 max-w-6xl mx-auto">Select the path that best describes your dating goals</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                <!-- The Analyzer -->
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-400 to-rose-400 rounded-2xl blur opacity-0 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                        <div class="text-5xl mb-6 text-center transform group-hover:scale-110 transition-transform">🧠</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">The Analyzer</h3>
                        <p class="text-gray-600 text-center text-sm italic">"I need personality, depth, and someone who actually communicates."</p>
                        <div class="mt-6 text-center">
                            <span class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">DEEP THINKER</span>
                        </div>
                    </div>
                </div>

                <!-- The Romantic -->
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-400 to-rose-400 rounded-2xl blur opacity-0 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                        <div class="text-5xl mb-6 text-center transform group-hover:scale-110 transition-transform">💕</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">The Romantic</h3>
                        <p class="text-gray-600 text-center text-sm italic">"I'm looking for chemistry, emotional warmth, and genuine connection."</p>
                        <div class="mt-6 text-center">
                            <span class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">HEART-LED</span>
                        </div>
                    </div>
                </div>

                <!-- The Chaos Survivor -->
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-400 to-rose-400 rounded-2xl blur opacity-0 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                        <div class="text-5xl mb-6 text-center transform group-hover:scale-110 transition-transform">🦋</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">The Chaos Survivor</h3>
                        <p class="text-gray-600 text-center text-sm italic">"I have endless stories; now I'm ready for someone stable."</p>
                        <div class="mt-6 text-center">
                            <span class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">GROWN & READY</span>
                        </div>
                    </div>
                </div>

                <!-- The Serious One -->
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-pink-400 to-rose-400 rounded-2xl blur opacity-0 group-hover:opacity-75 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
                        <div class="text-5xl mb-6 text-center transform group-hover:scale-110 transition-transform">💎</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">The Serious One</h3>
                        <p class="text-gray-600 text-center text-sm italic">"I'm here for a real relationship with emotional maturity."</p>
                        <div class="mt-6 text-center">
                            <span class="inline-block px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">COMMITMENT-FOCUSED</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Vibe Selection -->
        <div class="mb-20 animate-fade-in-up animation-delay-1000">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Swipe With Intention</h2>
                <p class="text-xl text-gray-600 max-w-6xl mx-auto">What matters most in your ideal relationship?</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer border-2 border-transparent hover:border-pink-200">
                    <div class="text-4xl mb-4 text-center transform group-hover:scale-110 transition-transform">😄</div>
                    <p class="font-semibold text-gray-800 text-center mb-3">I want someone who makes me laugh.</p>
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">HUMOR</span>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer border-2 border-transparent hover:border-pink-200">
                    <div class="text-4xl mb-4 text-center transform group-hover:scale-110 transition-transform">💬</div>
                    <p class="font-semibold text-gray-800 text-center mb-3">I want meaningful conversations.</p>
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">COMMUNICATION</span>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer border-2 border-transparent hover:border-pink-200">
                    <div class="text-4xl mb-4 text-center transform group-hover:scale-110 transition-transform">🌟</div>
                    <p class="font-semibold text-gray-800 text-center mb-3">I want adventure and spontaneity.</p>
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">ADVENTURE</span>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer border-2 border-transparent hover:border-pink-200">
                    <div class="text-4xl mb-4 text-center transform group-hover:scale-110 transition-transform">🧘</div>
                    <p class="font-semibold text-gray-800 text-center mb-3">I want emotional stability.</p>
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">STABILITY</span>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-lg p-8 hover:shadow-2xl transition-all duration-300 transform hover:scale-105 cursor-pointer border-2 border-transparent hover:border-pink-200">
                    <div class="text-4xl mb-4 text-center transform group-hover:scale-110 transition-transform">🤝</div>
                    <p class="font-semibold text-gray-800 text-center mb-3">I want a partner, not a project.</p>
                    <div class="text-center">
                        <span class="inline-block px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">PARTNERSHIP</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mini Quiz Preview -->
        <div class="bg-white rounded-3xl shadow-xl p-12 mb-20 animate-fade-in-up animation-delay-1200">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Ten-Second Starter Quiz</h2>
                <p class="text-xl text-gray-600 max-w-6xl mx-auto">Get instant insights about your dating personality</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                <div class="text-center">
                    <div class="bg-pink-50 rounded-2xl p-6 mb-4">
                        <h3 class="font-semibold text-gray-800 mb-4">Perfect First Date</h3>
                        <div class="flex flex-wrap justify-center gap-2">
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Coffee</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Dinner</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Walk</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Activity</span>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-pink-50 rounded-2xl p-6 mb-4">
                        <h3 class="font-semibold text-gray-800 mb-4">Texting Style</h3>
                        <div class="flex flex-wrap justify-center gap-2">
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Fast</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Slow</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Memes</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Long</span>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <div class="bg-pink-50 rounded-2xl p-6 mb-4">
                        <h3 class="font-semibold text-gray-800 mb-4">Biggest Dating Ick</h3>
                        <div class="flex flex-wrap justify-center gap-2">
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Hygiene</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Effort</span>
                            <span class="px-4 py-2 bg-pink-100 text-pink-700 rounded-full text-sm font-medium hover:bg-pink-200 transition-colors cursor-pointer">Communication</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-pink-50 to-rose-50 rounded-2xl p-8 max-w-6xl mx-auto border border-pink-100">
                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-500 rounded-full mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-lg font-bold text-gray-800 mb-2">Instant Result Example:</p>
                    <p class="text-gray-700 italic text-lg leading-relaxed">"You attract confident personalities, but your best match is someone grounded, emotionally present, and consistent."</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center animate-fade-in-up animation-delay-1400">
            <div class="bg-gradient-to-br from-pink-500 to-rose-500 rounded-3xl shadow-2xl p-16 relative overflow-hidden">
                <div class="absolute inset-0 bg-white/10 animate-pulse"></div>
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-full mb-8">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-4xl font-bold text-white mb-6">Ready to Begin Your Journey?</h2>
                    <p class="text-xl text-white/90 mb-10 max-w-6xl mx-auto leading-relaxed">
                        Are you ready to meet someone who communicates consistently, experience real compatibility, and make dating feel fun again?
                    </p>
                    <a href="{{ route('quiz.show', 1) }}" 
                       class="group inline-flex items-center px-12 py-6 bg-white text-pink-600 font-bold text-xl rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300">
                        <span class="flex items-center gap-3">
                            Start Your Love Project
                            <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<style>
    /* Custom Animations */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slide-in-down {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
        opacity: 0;
    }
    
    .animate-slide-in-down {
        animation: slide-in-down 0.8s ease-out forwards;
        opacity: 0;
    }
    
    .animation-delay-200 {
        animation-delay: 0.2s;
    }
    
    .animation-delay-400 {
        animation-delay: 0.4s;
    }
    
    .animation-delay-600 {
        animation-delay: 0.6s;
    }
    
    .animation-delay-800 {
        animation-delay: 0.8s;
    }
    
    .animation-delay-1000 {
        animation-delay: 1.0s;
    }
    
    .animation-delay-1200 {
        animation-delay: 1.2s;
    }
    
    .animation-delay-1400 {
        animation-delay: 1.4s;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
    
    /* Glass effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    /* Smooth transitions */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>
@endsection
