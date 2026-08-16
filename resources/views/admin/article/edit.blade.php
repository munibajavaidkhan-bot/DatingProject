@extends('layouts.admin-layout')

@section('title', 'Edit Article')
@section('page-title', 'Edit Article')

@section('content')

<div class="admin-card" style="max-width:800px;">
    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.article._form', ['article' => $article])
        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:12px 24px;font-weight:600;cursor:pointer;margin-top:16px;">
            Save Changes
        </button>
    </form>
</div>

@endsection
