@extends('layouts.author-layout')

@section('title', 'New Poem')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 style="font-family:'Playfair Display',serif;font-weight:700;margin:0;">New Poem</h1>
    <a href="{{ route('author.poems.index') }}" class="btn btn-outline-secondary">Back</a>
</div>

<div class="card-box">
    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)<p class="mb-1">• {{ $error }}</p>@endforeach
    </div>
    @endif

    <form action="{{ route('author.poems.store') }}" method="POST">
        @csrf
        @include('author.poem._form', ['poem' => null])
        <button type="submit" class="btn text-white mt-3" style="background:linear-gradient(135deg,#a855f7,#ec4899);">Save Poem</button>
    </form>
</div>
@endsection