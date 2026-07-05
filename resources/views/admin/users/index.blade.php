{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.admin-layout')

@section('title', 'Users')
@section('page-title', 'User Management')

@section('content')

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    @foreach([
        ['Total','all','#ec4899','fa-users'],
        ['Active','active','#22c55e','fa-user-check'],
        ['Suspended','suspended','#ef4444','fa-user-slash'],
        ['Admins','admin','#a855f7','fa-shield'],
    ] as [$label,$key,$color,$icon])
    <div class="col-6 col-md-3">
        <div class="admin-card" style="text-align:center;">
            <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:22px;margin-bottom:8px;display:block;"></i>
            <div style="font-size:26px;font-weight:800;color:white;">{{ $totals[$key] ?? 0 }}</div>
            <div style="font-size:12px;color:#9ca3af;">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="admin-card mb-4">
    <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email..."
                       style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px 14px;color:white;font-size:14px;outline:none;">
            </div>
            <div class="col-md-3">
                <select name="role" style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px 14px;color:white;font-size:14px;outline:none;">
                    <option value="">All Roles</option>
                    <option value="user"   {{ request('role') === 'user'   ? 'selected' : '' }}>User</option>
                    <option value="author" {{ request('role') === 'author' ? 'selected' : '' }}>Author</option>
                    <option value="admin"  {{ request('role') === 'admin'  ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px 14px;color:white;font-size:14px;outline:none;">
                    <option value="">All Status</option>
                    <option value="active"    {{ request('status') === 'active'    ? 'selected' : '' }}>Active</option>
                    <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                    <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="admin-btn flex-fill">Filter</button>
                <a href="{{ route('admin.users.index') }}" style="padding:8px 12px;border-radius:10px;background:rgba(255,255,255,0.08);color:#9ca3af;text-decoration:none;font-size:13px;display:flex;align-items:center;">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Users Table --}}
<div class="admin-card">
    <table class="admin-table w-100">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Profile</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $u)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <img src="{{ $u->getAvatarUrl() }}" style="width:36px;height:36px;border-radius:50%;object-fit:cover;">
                        <div>
                            <div style="font-weight:600;color:white;font-size:13px;">{{ $u->name }}</div>
                            <div style="font-size:11px;color:#6b7280;">
                                {{ $u->profile?->city ?? 'No location' }}
                            </div>
                        </div>
                    </div>
                </td>
                <td style="color:#9ca3af;">{{ $u->email }}</td>
                <td>
                    <span style="background:{{ $u->role === 'admin' ? 'rgba(239,68,68,0.15)' : ($u->role === 'author' ? 'rgba(168,85,247,0.15)' : 'rgba(236,72,153,0.15)') }};
                                color:{{ $u->role === 'admin' ? '#ef4444' : ($u->role === 'author' ? '#a855f7' : '#ec4899') }};
                                font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:capitalize;">
                        {{ $u->role }}
                    </span>
                </td>
                <td>
                    <button onclick="toggleStatus({{ $u->id }}, this)"
                            data-status="{{ $u->status }}"
                            style="background:{{ $u->status === 'active' ? 'rgba(34,197,94,0.15)' : 'rgba(239,68,68,0.15)' }};
                                   color:{{ $u->status === 'active' ? '#22c55e' : '#ef4444' }};
                                   border:none;border-radius:20px;font-size:11px;font-weight:700;padding:3px 12px;cursor:pointer;text-transform:capitalize;">
                        {{ $u->status }}
                    </button>
                </td>
                <td>
                    @if($u->profile?->is_complete)
                        <span style="color:#22c55e;font-size:12px;"><i class="fas fa-check-circle"></i> Complete</span>
                    @else
                        <span style="color:#f59e0b;font-size:12px;"><i class="fas fa-clock"></i> Incomplete</span>
                    @endif
                </td>
                <td style="color:#6b7280;font-size:12px;">{{ $u->created_at->format('M d, Y') }}</td>
                <td>
                    <div style="display:flex;gap:6px;">
                        <a href="{{ route('admin.users.edit', $u->id) }}"
                           style="background:rgba(99,102,241,0.15);color:#6366f1;border:none;border-radius:8px;padding:6px 10px;font-size:12px;cursor:pointer;text-decoration:none;">
                            <i class="fas fa-pen"></i>
                        </a>
                        @if($u->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                              onsubmit="return confirm('Delete {{ $u->name }}? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit" style="background:rgba(239,68,68,0.15);color:#ef4444;border:none;border-radius:8px;padding:6px 10px;font-size:12px;cursor:pointer;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;padding:40px;color:#6b7280;">
                    <i class="fas fa-users-slash fa-2x mb-3 d-block"></i>
                    No users found
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:16px;">
        {{ $users->withQueryString()->links() }}
    </div>
</div>

@endsection

@push('scripts')
<script>
async function toggleStatus(userId, btn) {
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const res  = await fetch(`/admin/users/${userId}/toggle-status`, {
        method: 'PATCH',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
    });
    const data = await res.json();
    if (data.success) {
        const isActive = data.status === 'active';
        btn.textContent = data.status;
        btn.dataset.status = data.status;
        btn.style.background = isActive ? 'rgba(34,197,94,0.15)' : 'rgba(239,68,68,0.15)';
        btn.style.color = isActive ? '#22c55e' : '#ef4444';
    }
}
</script>
@endpush