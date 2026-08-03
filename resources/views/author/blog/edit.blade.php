@extends('layouts.author-layout')

@section('title', 'Edit Article')

@section('content')
<h1 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:24px;">Edit Article</h1>
<div class="card-box">
    <form action="{{ route('author.blog.update', $post->id) }}" method="POST">
        @csrf @method('PUT')
        @include('author.blog._form', ['post' => $post])
        <input type="hidden" name="status" value="{{ $post->status }}">
        <button type="submit" class="btn text-white mt-3" style="background:linear-gradient(135deg,#ec4899,#a855f7);">Save Changes</button>
    </form>
</div>
@endsection
