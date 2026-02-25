{{-- resources/views/auth/login.blade.php --}}

@extends('layouts.guest-layout')

@section('content')
<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2 class="text-3xl font-bold text-gray-800 mb-2">Welcome Back!</h2>
        <p class="text-gray-600 mb-8">Continue your journey to forever.</p>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-pink-300 text-pink-600 shadow-sm focus:ring-pink-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="text-sm text-purple-600 hover:text-purple-700 underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700">
                {{ __('Log In') }}
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-600">
            New here? 
            <a href="{{ route('register') }}" class="font-semibold text-purple-600 hover:text-purple-700">
                Create an account
            </a>
        </p>
    </form>
</x-guest-layout>
@endsection