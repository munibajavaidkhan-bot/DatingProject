@extends('layouts.admin-layout')

@section('title', 'Create Article')
@section('page-title', 'Create Article')

@section('content')

<div class="admin-card" style="max-width:800px;">
    @if($errors->any())
    <div style="background:rgba(239,68,68,0.15);border:1px solid #ef4444;border-radius:12px;padding:14px;margin-bottom:20px;">
        @foreach($errors->all() as $error)<p style="color:#ef4444;font-size:13px;margin:0;">• {{ $error }}</p>@endforeach
    </div>
    @endif

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.article._form', ['article' => null])
        <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:12px 24px;font-weight:600;cursor:pointer;margin-top:16px;">
            Create Article
        </button>
    </form>
</div>

@endsection
