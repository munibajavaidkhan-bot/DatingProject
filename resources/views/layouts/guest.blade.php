{{-- resources/views/layouts/guest.blade.php --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'The Love Project') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-pink-50 via-purple-50 to-rose-50 min-h-screen flex items-center justify-center p-4">

    <!-- SINGLE LAYOUT FOR ALL SCREENS -->
    <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden lg:grid lg:grid-cols-12">

        <!-- LEFT: IMAGE (Desktop Only) -->
        <div class="hidden lg:block col-span-6 relative">
            <img 
                src="{{ asset('images/couple-love.png') }}" 
                alt="Couple in love" 
                class="w-full h-full object-cover"
                onerror="this.src='https://via.placeholder.com/800x600/f8b4d9/ffffff?text=Love'"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-8 left-8 text-white">
                <p class="text-2xl font-bold">"52 Weeks to Forever"</p>
                <p class="text-sm">Find love that lasts.</p>
            </div>
        </div>

        <!-- RIGHT: FORM AREA (Desktop + Mobile) -->
        <div class="col-span-6 p-8 lg:p-12 flex flex-col justify-center bg-white">

            <!-- Mobile: Image on Top -->
            <div class="lg:hidden mb-6 relative h-48 -mx-8 -mt-8 rounded-t-3xl overflow-hidden">
                <img src="{{ asset('images/couple-love.png') }}" alt="Couple" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-4 left-4 text-white">
                    <p class="text-lg font-bold">"52 Weeks to Forever"</p>
                </div>
            </div>

            <!-- Logo + Form -->
            <div class="flex items-center gap-3 mb-6 lg:mb-8">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-br from-pink-500 to-purple-600 text-white rounded-full flex items-center justify-center shadow-lg p-2">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 lg:w-7 lg:h-7">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </div>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-800">The Love Project</h1>
            </div>

            <!-- FORM CONTENT (Only Once) -->
            {{ $slot }}

        </div>
    </div>

</body>
</html>