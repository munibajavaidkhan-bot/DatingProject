@extends('layouts.admin-layout')

@section('title', 'Edit Content')
@section('page-title', 'Edit Week ' . ($week->week_number ?? ''))

@section('content')

<div class="admin-card" style="max-width:700px;">
  @if(isset($week))
  <h5 style="color:white;font-weight:700;margin-bottom:8px;">Week {{ $week->week_number }}: {{ $week->title }}</h5>
  <p style="color:#9ca3af;font-size:13px;margin-bottom:20px;">{{ $week->subtitle }}</p>
  @endif
  <p style="color:#9ca3af;font-size:14px;">Content editor coming soon.</p>
  <a href="{{ route('admin.content.index') }}" style="color:#ec4899;text-decoration:none;font-size:14px;font-weight:600;">
    <i class="fas fa-arrow-left me-2"></i>Back to Content
  </a>
</div>

@endsection
