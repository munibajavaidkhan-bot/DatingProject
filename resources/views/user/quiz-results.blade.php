@extends('layouts.user-layout')
@section('title', 'Your Compatibility Results')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0 min-h-screen p-6 lg:p-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">
                Your Compatibility Profile
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Based on your answers, here's your personality type and compatibility insights
            </p>
        </div>

        <!-- Personality Type Card -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 mb-8">
            <div class="text-center">
                <div class="text-6xl mb-4">
                    @if($personalityType === 'The Analyzer') 🧠
                    @elseif($personalityType === 'The Romantic') 💕
                    @elseif($personalityType === 'The Chaos Survivor') 🦋
                    @else 💎
                    @endif
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $personalityType }}</h2>
                <div class="bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl p-6 max-w-2xl mx-auto">
                    <p class="text-lg text-gray-700">
                        @if($personalityType === 'The Analyzer')
                        You value deep conversations, intellectual connections, and authentic communication. You're looking for someone who stimulates your mind and shares your curiosity about the world.
                        @elseif($personalityType === 'The Romantic')
                        You're driven by emotional connection, chemistry, and genuine warmth. You seek meaningful relationships built on trust, affection, and shared dreams.
                        @elseif($personalityType === 'The Chaos Survivor')
                        You've experienced enough drama and now crave stability, consistency, and emotional maturity. You're ready for a peaceful, supportive partnership.
                        @else
                        You're serious about finding a lasting relationship and value emotional maturity, clear communication, and shared life goals.
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Compatibility Score -->
        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Quiz Completion</h3>
                <div class="text-center">
                    <div class="text-5xl font-bold text-purple-600 mb-2">{{ $compatibilityScore }}%</div>
                    <p class="text-gray-600">Profile Complete</p>
                    <div class="mt-4 w-full bg-gray-200 rounded-full h-4">
                        <div class="h-full rounded-full bg-gradient-to-r from-purple-500 to-pink-500" style="width: {{ $compatibilityScore }}%"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Your Strengths</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Clear communication style</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Defined relationship goals</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Self-aware preferences</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-pink-500 rounded-full mr-3"></div>
                        <span class="text-gray-700">Emotional maturity</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Matches -->
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl p-8 mb-8">
            <h3 class="text-3xl font-bold text-gray-800 mb-6">Your Recommended Matches</h3>
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($recommendedMatches as $match)
                <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-2xl p-6 hover:shadow-lg transition-all">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 bg-gradient-to-br from-pink-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl mr-4">
                            {{ substr($match['name'], 0, 1) }}{{ substr(explode(' ', $match['name'])[1] ?? '', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-800">{{ $match['name'] }}</h4>
                            <p class="text-gray-600">{{ $match['age'] }} • {{ $match['location'] }}</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-semibold text-gray-700">Compatibility</span>
                            <span class="text-2xl font-bold text-green-600">{{ $match['compatibility'] }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="h-full rounded-full bg-gradient-to-r from-green-400 to-green-600" style="width: {{ $match['compatibility'] }}%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                            {{ $match['personality_match'] }}
                        </span>
                    </div>
                    <p class="text-gray-700 text-sm italic">{{ $match['description'] }}</p>
                    <div class="mt-4 flex gap-3">
                        <button class="px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-colors">
                            View Profile
                        </button>
                        <button class="px-4 py-2 bg-white text-purple-600 border-2 border-purple-300 rounded-full hover:bg-purple-50 transition-colors">
                            Send Message
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6">What's Next?</h3>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('user.matches') }}" 
                       class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                        Explore All Matches
                    </a>
                    <a href="{{ route('user.dashboard') }}" 
                       class="px-8 py-4 bg-white text-purple-600 font-bold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all border-2 border-purple-200">
                        Back to Dashboard
                    </a>
                    <a href="#" class="px-8 py-4 bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-800 font-bold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                        Share Results
                    </a>
                </div>
            </div>
        </div>

        <!-- Insights Section -->
        <div class="mt-12 bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Your Dating Insights</h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="text-4xl mb-3">🎯</div>
                    <h4 class="font-bold text-gray-800 mb-2">Clear Intentions</h4>
                    <p class="text-gray-600 text-sm">You know what you want and aren't afraid to communicate your needs clearly.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-3">💬</div>
                    <h4 class="font-bold text-gray-800 mb-2">Communication Style</h4>
                    <p class="text-gray-600 text-sm">Your approach to communication will help build strong, lasting connections.</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl mb-3">🌟</div>
                    <h4 class="font-bold text-gray-800 mb-2">Compatibility Focus</h4>
                    <p class="text-gray-600 text-sm">You prioritize genuine compatibility over superficial qualities.</p>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
</style>
@endsection
