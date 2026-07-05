{{-- resources/views/admin/users/edit.blade.php --}}
@extends('layouts.admin-layout')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center">
            <img src="{{ $user->getAvatarUrl() }}"
                 style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid #ec4899;margin-bottom:16px;">
            <h5 style="color:white;font-weight:700;">{{ $user->name }}</h5>
            <p style="color:#9ca3af;font-size:13px;">{{ $user->email }}</p>

            <div style="display:flex;flex-direction:column;gap:8px;margin-top:16px;">
                @foreach([
                    ['Joined','created_at','format','M d, Y'],
                    ['Last Active','updated_at','format','M d, Y'],
                ] as [$label,$field,$method,$arg])
                <div style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid rgba(255,255,255,0.06);">
                    <span style="color:#6b7280;font-size:13px;">{{ $label }}</span>
                    <span style="color:white;font-size:13px;">{{ $user->$field->$method($arg) }}</span>
                </div>
                @endforeach
                <div style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid rgba(255,255,255,0.06);">
                    <span style="color:#6b7280;font-size:13px;">Profile</span>
                    <span style="color:{{ $user->profile?->is_complete ? '#22c55e' : '#f59e0b' }};font-size:13px;font-weight:600;">
                        {{ $user->profile?->is_complete ? 'Complete' : 'Incomplete' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <h5 style="color:white;font-weight:700;margin-bottom:24px;">Edit User Details</h5>

            @if($errors->any())
            <div style="background:rgba(239,68,68,0.15);border:1px solid #ef4444;border-radius:12px;padding:14px;margin-bottom:20px;">
                @foreach($errors->all() as $error)
                <p style="color:#ef4444;font-size:13px;margin:0;">• {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px;">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:11px 14px;color:white;font-size:14px;outline:none;"
                               onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" required>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px;">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:11px 14px;color:white;font-size:14px;outline:none;"
                               onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'" required>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px;">Role</label>
                        <select name="role" style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:11px 14px;color:white;font-size:14px;outline:none;">
                            @foreach(['user'=>'User','author'=>'Author','admin'=>'Admin'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('role',$user->role) === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px;">Status</label>
                        <select name="status" style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:11px 14px;color:white;font-size:14px;outline:none;">
                            @foreach(['active'=>'Active','suspended'=>'Suspended','pending'=>'Pending'] as $v=>$l)
                            <option value="{{ $v }}" {{ old('status',$user->status) === $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label style="font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:1px;display:block;margin-bottom:6px;">
                        New Password <span style="font-weight:400;text-transform:none;color:#4b5563;">(leave blank to keep current)</span>
                    </label>
                    <input type="password" name="password"
                           style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:11px 14px;color:white;font-size:14px;outline:none;"
                           onfocus="this.style.borderColor='#ec4899'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                           placeholder="Enter new password (min 8 characters)">
                </div>

                <div style="padding-top:16px;border-top:1px solid rgba(255,255,255,0.06);display:flex;gap:10px;justify-content:flex-end;">
                    <a href="{{ route('admin.users.index') }}"
                       style="padding:11px 22px;border-radius:10px;border:1px solid rgba(255,255,255,0.1);color:#9ca3af;font-size:14px;font-weight:600;text-decoration:none;">
                        Cancel
                    </a>
                    <button type="submit" class="admin-btn" style="padding:11px 28px;">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection