{{-- resources/views/components/guest-layout.blade.php --}}
<div class="w-full max-w-md px-4">
    <div class="text-center mb-8">
        <div class="mx-auto h-16 w-16 rounded-full bg-gradient-to-r from-pink-500 to-purple-600 flex items-center justify-center shadow-lg">
            <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21s-8-4.978-8-11a5 5 0 0110 0 5 5 0 0110 0c0 6.022-8 11-8 11z"/>
            </svg>
        </div>
        <h1 class="mt-6 text-3xl font-bold text-gray-900">The Love Project</h1>
        <p class="mt-2 text-gray-600">52 Weeks to Forever</p>
    </div>
    
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        {{ $slot }}
    </div>
</div>
