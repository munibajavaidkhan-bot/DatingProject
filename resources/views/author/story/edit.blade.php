@extends('layouts.author-layout')

@section('title', 'Edit Story')

@section('content')
<h1 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:24px;">Edit Story</h1>
<div class="card-box">
    <form action="{{ route('author.stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('author.story._form', ['story' => $story])
        <input type="hidden" name="status" value="{{ $story->status }}">
        <button type="submit" class="btn text-white mt-3" style="background:linear-gradient(135deg,#ec4899,#a855f7);">Save Changes</button>
    </form>
</div>
@endsection
