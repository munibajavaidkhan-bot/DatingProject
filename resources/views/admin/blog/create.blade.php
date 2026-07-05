@extends('layouts.admin-layout')

@section('title', 'Create Blog Post')
@section('page-title', 'Create Blog Post')

@section('content')

<div class="admin-card" style="max-width:700px;">
  <p style="color:#9ca3af;font-size:14px;">Blog post creation form coming soon. Use the seeder or database to add posts for now.</p>
  <a href="{{ route('admin.blog.index') }}" style="color:#ec4899;text-decoration:none;font-size:14px;font-weight:600;">
    <i class="fas fa-arrow-left me-2"></i>Back to Posts
  </a>
</div>

@endsection
