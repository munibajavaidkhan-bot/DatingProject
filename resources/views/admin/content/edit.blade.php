@extends('layouts.admin-layout')

@section('title', 'Edit Week ' . $week->week_number)
@section('page-title', 'Edit Content — Week ' . $week->week_number)

@section('content')

<div class="admin-card" style="max-width:900px;">
    <form action="{{ route('admin.content.update', $week->id) }}" method="POST">
        @csrf @method('PUT')

        <div style="display:grid;gap:16px;">
            <div class="row g-3">
                <div class="col-md-8">
                    <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Title</label>
                    <input type="text" name="title" value="{{ old('title', $week->title) }}" required
                           style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                </div>
                <div class="col-md-4">
                    <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Est. Minutes</label>
                    <input type="number" name="estimated_minutes" value="{{ old('estimated_minutes', $week->estimated_minutes) }}" min="1"
                           style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                </div>
            </div>
            <div>
                <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $week->subtitle) }}"
                       style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
            </div>
            <div>
                <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Description</label>
                <textarea name="description" rows="2" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('description', $week->description) }}</textarea>
            </div>
            <div>
                <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Content</label>
                <textarea name="content" rows="12" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('content', $week->content) }}</textarea>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Theme</label>
                    <input type="text" name="theme" value="{{ old('theme', $week->theme) }}"
                           style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                </div>
                <div class="col-md-4">
                    <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Category</label>
                    <input type="text" name="category" value="{{ old('category', $week->category) }}"
                           style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                </div>
                <div class="col-md-4">
                    <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url', $week->video_url) }}"
                           style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                </div>
            </div>
            <div style="display:flex;gap:24px;">
                <label style="color:#d1d5db;font-size:14px;cursor:pointer;">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $week->is_published) ? 'checked' : '' }}> Published
                </label>
                <label style="color:#d1d5db;font-size:14px;cursor:pointer;">
                    <input type="checkbox" name="is_premium" value="1" {{ old('is_premium', $week->is_premium) ? 'checked' : '' }}> Premium only
                </label>
            </div>
        </div>

        <div style="margin-top:24px;display:flex;gap:12px;">
            <button type="submit" style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;border:none;border-radius:10px;padding:12px 24px;font-weight:600;cursor:pointer;">Save Week</button>
            <a href="{{ route('admin.content.index') }}" style="color:#9ca3af;text-decoration:none;padding:12px 16px;">Cancel</a>
        </div>
    </form>
</div>

@endsection
