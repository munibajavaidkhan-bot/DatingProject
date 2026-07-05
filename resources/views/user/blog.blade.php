@extends('layouts.user-layout')
@section('title', 'Expert Advice — The Love Project')

@section('content')
<div class="w-screen h-screen bg-gradient-to-br from-rose-50 via-purple-50 to-pink-50 fixed top-0 left-0 -z-10"></div>

<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">The Love Journal</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">Insights, advice, and stories from relationship experts to guide you on your journey to meaningful connection.</p>
    </div>

    {{-- Category Filter --}}
    @if($categories->count())
    <div class="flex flex-wrap justify-center gap-3 mb-10">
        <a href="{{ route('member.blog') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ !request('category') ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white' : 'bg-white/70 text-gray-600 hover:bg-white' }}">
            All
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('member.blog', ['category' => $cat->slug]) }}"
           class="px-5 py-2 rounded-full text-sm font-semibold transition {{ request('category') === $cat->slug ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white' : 'bg-white/70 text-gray-600 hover:bg-white' }}">
            {{ $cat->name }}
        </a>
        @endforeach
    </div>
    @endif

    {{-- Featured --}}
    @if($featured->count() && !request('category') && !request('search'))
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6" style="font-family:'Playfair Display',serif;">Featured</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($featured as $fp)
            <a href="{{ route('member.blog.show', $fp->slug) }}" class="group bg-white/70 backdrop-blur-md rounded-2xl p-6 shadow-lg border border-white/20 hover:shadow-xl transition text-decoration-none">
                <span class="text-xs font-bold text-pink-600 uppercase">{{ $fp->category?->name ?? 'Advice' }}</span>
                <h3 class="text-lg font-bold text-gray-800 mt-2 group-hover:text-pink-600 transition">{{ $fp->title }}</h3>
                <p class="text-gray-600 text-sm mt-2">{{ Str::limit($fp->excerpt, 80) }}</p>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Blog Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="group bg-white/70 backdrop-blur-md rounded-3xl overflow-hidden shadow-lg border border-white/20 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="relative h-56 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1518199266791-5375a83190b7?q=80&w=800&auto=format&fit=crop" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $post->title }}">
                    <div class="absolute top-4 left-4">
                        <span class="bg-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">New</span>
                    </div>
                </div>
                <div class="p-6 lg:p-8">
                    <div class="flex items-center gap-2 text-xs text-pink-600 font-bold uppercase tracking-wider mb-3">
                        <i class="fas fa-heart"></i>
                        <span>Advice</span>
                        <span class="text-gray-300">•</span>
                        <span>5 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-pink-600 transition">{{ $post->title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        {{ Str::limit($post->excerpt ?? strip_tags($post->body), 120) }}
                    </p>
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-3">
                            <img src="{{ $post->author->getAvatarUrl() }}" class="w-8 h-8 rounded-full object-cover" alt="">
                            <span class="text-xs font-semibold text-gray-700">{{ $post->author->name }}</span>
                        </div>
                        <a href="{{ route('member.blog.show', $post->slug) }}" class="text-pink-600 font-bold text-sm hover:underline flex items-center gap-1">
                            Read More <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-20">
                <div class="inline-block p-6 rounded-full bg-white/50 mb-6">
                    <i class="fas fa-book-open text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-400">Coming Soon</h3>
                <p class="text-gray-500">Our experts are preparing new articles for you.</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>
@endsection
