@extends('layouts.admin-layout')

@section('title', 'Edit Story')
@section('page-title', 'Edit Story')

@section('content')

<div class="admin-card" style="max-width:800px;">
    <form action="{{ route('admin.stories.update', $story->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @include('admin.story._form', ['story' => $story])
        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:12px 24px;font-weight:600;cursor:pointer;margin-top:16px;">
            Save Changes
        </button>
    </form>
</div>

@endsection
