@extends('layouts.author-layout')

@section('title', 'New Story')

@section('content')
<h1 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:24px;">Write New Story</h1>
<div class="card-box">
    <form action="{{ route('author.stories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('author.story._form')
        <button type="submit" name="publish" value="0" class="btn btn-outline-secondary mt-3 me-2">Save Draft</button>
        <button type="submit" name="publish" value="1" class="btn text-white mt-3" style="background:linear-gradient(135deg,#ec4899,#a855f7);">Publish</button>
    </form>
</div>
@endsection
