@extends('layouts.admin-layout')

@section('title', 'Feature Settings')
@section('page-title', 'Feature Settings')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p style="color:#9ca3af;font-size:14px;margin:0;">Toggle features on/off across the platform.</p>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(380px, 1fr));gap:20px;">
        @foreach($settings as $group => $items)
        <div class="admin-card">
            <h5 style="color:#e5e7eb;font-size:16px;font-weight:700;margin-bottom:16px;text-transform:capitalize;">
                <i class="fas fa-cog me-2" style="color:#a855f7;"></i>{{ str_replace('_', ' ', $group) }}
            </h5>

            @foreach($items as $setting)
            <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 0;{{ !$loop->last ? 'border-bottom:1px solid rgba(255,255,255,0.04);' : '' }}">
                <div style="flex:1;">
                    <div style="color:#e5e7eb;font-size:14px;font-weight:600;">{{ $setting->label }}</div>
                    @if($setting->description)
                    <div style="color:#6b7280;font-size:12px;margin-top:2px;">{{ $setting->description }}</div>
                    @endif
                </div>
                <label style="position:relative;display:inline-block;width:48px;height:26px;cursor:pointer;">
                    <input type="checkbox" name="settings[{{ $setting->key }}]" value="1"
                        {{ $setting->value ? 'checked' : '' }}
                        style="opacity:0;width:0;height:0;">
                    <span style="position:absolute;inset:0;background:#374151;border-radius:13px;transition:.3s;"></span>
                    <span style="position:absolute;top:3px;left:3px;width:20px;height:20px;background:white;border-radius:50%;transition:.3s;"></span>
                </label>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>

    <div style="margin-top:24px;text-align:right;">
        <button type="submit" class="admin-btn" style="padding:12px 28px;">
            <i class="fas fa-save me-1"></i> Save All Settings
        </button>
    </div>
</form>

<style>
    input[type="checkbox"]:checked + span:first-of-type { background: linear-gradient(135deg,#ec4899,#a855f7); }
    input[type="checkbox"]:checked + span:last-of-type { transform: translateX(22px); }
</style>
@endsection
