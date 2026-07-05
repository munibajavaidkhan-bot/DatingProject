@extends('layouts.admin-layout')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit: ' . Str::limit($post->title, 40))

@section('content')

<div class="admin-card" style="max-width:700px;">
  <h5 style="color:white;font-weight:700;margin-bottom:8px;">{{ $post->title }}</h5>
  <p style="color:#9ca3af;font-size:13px;margin-bottom:20px;">Status: {{ $post->status }} · {{ $post->views }} views</p>
  <p style="color:#9ca3af;font-size:14px;">Full blog editor coming soon.</p>
  <a href="{{ route('admin.blog.index') }}" style="color:#ec4899;text-decoration:none;font-size:14px;font-weight:600;">
    <i class="fas fa-arrow-left me-2"></i>Back to Posts
  </a>
</div>

@endsection
