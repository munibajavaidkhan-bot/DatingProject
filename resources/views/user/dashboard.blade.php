{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.user-layout')
@section('title', 'Your Love Dashboard')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-pink-100 via-purple-100 to-rose-100 fixed top-0 left-0 -z-10"></div>
<div class="relative z-0">
    <div class="p-4 lg:p-8">
        <div class="max-w-7xl mx-auto">

            <!-- Main Grid -->
        <div class="grid lg:grid-cols-3 gap-6">

            <!-- LEFT: Main Content -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Welcome + Progress Card -->
                <div class="glass-card p-6 lg:p-8 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                        <div>
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 flex items-center gap-3">
                                Hey, {{ auth()->user()->name }}
                                <span class="text-2xl animate-wave">👋</span>
                            </h2>
                            <p class="mt-2 text-gray-600">Welcome back — here’s your progress for <strong>Week #3</strong>.</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-5 py-2 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold shadow-lg transform hover:scale-105 transition">
                                Premium
                            </span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-6">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Progress</span>
                            <span class="font-semibold">45% complete</span>
                        </div>
                        <div class="w-full bg-white/50 rounded-full h-4 shadow-inner overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-pink-500 via-purple-500 to-rose-500 shadow-md transition-all duration-1000 ease-out" style="width: 45%"></div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Lesson -->
                <div class="glass-card p-6 lg:p-8 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20">
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-3">This Week’s Lesson</h3>
                    <p class="text-gray-600 mb-5 leading-relaxed">
                        <em>“How to open up again”</em> — A gentle guide to vulnerability. Includes a 5-min video + printable workbook.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#" class="neumorphic-btn bg-gradient-to-r from-pink-500 to-purple-600 text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                            Open Lesson
                        </a>
                        <a href="#" class="neumorphic-btn bg-white/80 text-gray-700 px-6 py-3 rounded-full font-semibold shadow-inner hover:shadow-md transition">
                            Mark Complete
                        </a>
                    </div>
                </div>

                <!-- Personality Quiz -->
                <div class="glass-card p-6 lg:p-8 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20">
                    <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-3">Personality Quiz</h3>
                    <p class="text-gray-600 mb-5">Unlock better matches with our 2-minute personality assessment.</p>
                        <a href="{{ route('quiz.index') }}" 
                        class="neumorphic-btn bg-gradient-to-r from-yellow-400 to-orange-500 text-gray-800 px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition inline-flex items-center gap-2">
                            </a>                        Start Quiz
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

            </div>

            <!-- RIGHT: Sidebar -->
            <aside class="space-y-6">

                <!-- Profile Card -->
                <div class="glass-card p-6 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20 text-center">
                    <div class="relative mx-auto w-32 h-32 mb-4">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-400 to-purple-600 rounded-full blur-xl opacity-50"></div>
                        <img
    src="{{ auth()->user()->profile_picture ? route('profile.photo', ['filename' => basename(auth()->user()->profile_picture)]) : asset('images/default-avatar.jpg') }}"
    alt="Profile"
    class="relative w-full h-full rounded-full object-cover border-4 border-white shadow-lg"
>
                    </div>
                    
                    <h4 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h4>
                    <p class="text-sm text-gray-600 mt-1">
                        Age: {{ auth()->user()->dob ?? '—' }} • 
                        {{ auth()->user()->location ?? 'City not set' }}
                    </p>
                    <a href="{{ route('profile.editById', auth()->id()) }}" 
                       class="mt-5 inline-block neumorphic-btn bg-white text-pink-600 px-6 py-3 rounded-full font-bold shadow-inner hover:shadow-md transition">
                        Edit Profile
                    </a>
                </div>

                <!-- Suggested Matches -->
                <div class="glass-card p-6 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Suggested Matches</h4>
                    <div class="space-y-4">
                        <!-- Match 1 -->
                        <div class="flex items-center gap-4 p-3 bg-white/50 rounded-2xl shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                JM
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Jerry M.</p>
                                <p class="text-xs text-gray-600">28 • Houston</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-600 font-bold text-lg">82%</p>
                                <a href="#" class="text-xs text-purple-600 hover:underline">View</a>
                            </div>
                        </div>

                        <!-- Match 2 -->
                        <div class="flex items-center gap-4 p-3 bg-white/50 rounded-2xl shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-400 to-pink-500 flex items-center justify-center text-white font-bold text-sm shadow-md">
                                AK
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">Alex K.</p>
                                <p class="text-xs text-gray-600">30 • Toronto</p>
                            </div>
                            <div class="text-right">
                                <p class="text-green-600 font-bold text-lg">78%</p>
                                <a href="#" class="text-xs text-purple-600 hover:underline">View</a>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('user.matches') }}" class="block mt-5 text-sm text-purple-600 font-semibold hover:underline text-center">
                        See all matches
                    </a>
                </div>

                <!-- Quick Actions -->
                <div class="glass-card p-6 rounded-3xl shadow-xl backdrop-blur-xl border border-white/20">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h4>
                    <div class="grid gap-3">
                        <a href="{{ route('quiz.index') }}" class="neumorphic-btn bg-white text-pink-600 px-5 py-3 rounded-full font-bold text-center shadow-inner hover:shadow-md transition">
                            Take Quiz
                        </a>
                        <a href="{{ route('user.matches') }}" class="neumorphic-btn bg-white text-pink-600 px-5 py-3 rounded-full font-bold text-center shadow-inner hover:shadow-md transition">
                            View Matches
                        </a>
                        <a href="{{ route('user.forum') }}" class="neumorphic-btn bg-white text-pink-600 px-5 py-3 rounded-full font-bold text-center shadow-inner hover:shadow-md transition">
                            Community
                        </a>
                    </div>
                </div>

            </aside>
        </div>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }
    .neumorphic-btn {
        transition: all 0.3s ease;
        box-shadow: 6px 6px 12px rgba(0,0,0,0.05), -6px -6px 12px rgba(255,255,255,0.8);
    }
    .neumorphic-btn:hover {
        box-shadow: 3px 3px 8px rgba(0,0,0,0.08), -3px -3px 8px rgba(255,255,255,0.9);
        transform: translateY(-2px);
    }
    @keyframes wave {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(20deg); }
        50% { transform: rotate(-10deg); }
        75% { transform: rotate(15deg); }
    }
    .animate-wave {
        display: inline-block;
        animation: wave 2s infinite;
        transform-origin: 70% 70%;
    }
</style>
@endsection