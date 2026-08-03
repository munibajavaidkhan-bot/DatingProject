@extends('layouts.admin-layout')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Post')

@section('content')

<div class="admin-card" style="max-width:800px;">
    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.blog._form', ['post' => $post])
        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:12px 24px;font-weight:600;cursor:pointer;margin-top:16px;">
            Save Changes
        </button>
    </form>
</div>

@endsection
