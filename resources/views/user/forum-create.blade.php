@extends('layouts.user-layout')

@section('title', 'New Thread')
@section('page-title', 'Start a Discussion')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="glass-card" style="padding:32px;">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;color:#1f2937;margin-bottom:8px;">Start a New Discussion</h3>
            <p style="color:#6b7280;font-size:14px;margin-bottom:28px;">Share your story, ask for advice, or start a conversation with the community.</p>

            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:12px;padding:14px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                <p style="color:#dc2626;font-size:13px;margin:0;">• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('member.forum.store') }}" method="POST">
                @csrf

                <div style="margin-bottom:20px;">
                    <label style="display:block;font-weight:600;font-size:14px;color:#374151;margin-bottom:8px;">Category</label>
                    <select name="category_id" required style="width:100%;padding:12px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;">
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:block;font-weight:600;font-size:14px;color:#374151;margin-bottom:8px;">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" required minlength="10" maxlength="200"
                           placeholder="What's on your mind?"
                           style="width:100%;padding:12px 16px;border:1.5px solid #e5e7eb;border-radius:12px;font-size:14px;">
                </div>

                <div style="margin-bottom:28px;">
                    <label style="display:block;font-weight:600;font-size:14px;color:#374151;margin-bottom:8px;">Your Message</label>
                    <textarea name="body" rows="8" required minlength="20" placeholder="Share your thoughts in detail..."
                              style="width:100%;padding:14px 16px;border:1.5px solid #e5e7eb;border-radius:14px;font-size:14px;line-height:1.6;resize:vertical;">{{ old('body') }}</textarea>
                </div>

                <div style="display:flex;gap:12px;justify-content:flex-end;">
                    <a href="{{ route('member.forum') }}" style="padding:12px 24px;border-radius:12px;color:#6b7280;text-decoration:none;font-weight:600;">Cancel</a>
                    <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:12px;padding:12px 28px;font-weight:700;cursor:pointer;">
                        <i class="fas fa-paper-plane me-2"></i>Post Thread
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
