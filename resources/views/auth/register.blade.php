{{-- resources/views/auth/register.blade.php --}}

@extends('layouts.guest-layout')

@section('content')
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-3xl font-bold text-gray-800 mb-2">Join The Love Project</h2>
        <p class="text-gray-600 mb-8">Start your 52-week journey to forever.</p>

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 justify-center">
                {{ __('Join Free Today') }}
            </x-primary-button>
        </div>

        <p class="mt-6 text-center text-sm text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-semibold text-purple-600 hover:text-purple-700">Sign in</a>
        </p>
    </form>
</x-guest-layout>
@endsection