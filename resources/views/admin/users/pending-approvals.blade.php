@extends('layouts.admin-layout')

@section('title', 'Pending Profile Approvals')
@section('page-title', 'Pending Profile Approvals')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <p style="color:#9ca3af;font-size:14px;margin:0;">Review and approve user profiles before they go live on the platform.</p>
</div>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Profile Info</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($profiles as $profile)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <img src="{{ $profile->user->getAvatarUrl() }}" alt="" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                            <div>
                                <div style="color:#e5e7eb;font-weight:600;font-size:13px;">{{ $profile->user->name }}</div>
                                <div style="color:#6b7280;font-size:11px;">{{ $profile->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div style="font-size:12px;color:#9ca3af;">
                            @if($profile->gender) <span><strong>Gender:</strong> {{ $profile->gender }}</span><br> @endif
                            @if($profile->city) <span><strong>Location:</strong> {{ $profile->city }}, {{ $profile->country }}</span><br> @endif
                            @if($profile->date_of_birth) <span><strong>Age:</strong> {{ $profile->age }}</span><br> @endif
                            @if($profile->personality_type) <span><strong>Type:</strong> {{ $profile->personality_type }}</span> @endif
                        </div>
                    </td>
                    <td style="color:#6b7280;font-size:12px;">{{ $profile->updated_at->diffForHumans() }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.users.show', $profile->user_id) }}" title="View Full Profile"
                                style="background:rgba(59,130,246,0.15);color:#60a5fa;padding:6px 12px;border-radius:8px;font-size:12px;text-decoration:none;">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <form action="{{ route('admin.approvals.approve', $profile->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" title="Approve Profile"
                                    style="background:rgba(34,197,94,0.15);color:#4ade80;padding:6px 12px;border-radius:8px;font-size:12px;border:none;cursor:pointer;">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                            </form>
                            <button type="button" title="Reject Profile" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $profile->id }}"
                                style="background:rgba(239,68,68,0.15);color:#f87171;padding:6px 12px;border-radius:8px;font-size:12px;border:none;cursor:pointer;">
                                <i class="fas fa-times"></i> Reject
                            </button>
                        </div>

                        <!-- Reject Modal -->
                        <div class="modal fade" id="rejectModal{{ $profile->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div style="background:#1a1a24;border:1px solid rgba(255,255,255,0.1);border-radius:16px;padding:24px;">
                                    <h5 style="color:#e5e7eb;margin-bottom:12px;">Reject Profile — {{ $profile->user->name }}</h5>
                                    <form action="{{ route('admin.approvals.reject', $profile->id) }}" method="POST">
                                        @csrf
                                        <textarea name="rejection_reason" required placeholder="Enter reason for rejection..."
                                            style="width:100%;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px;color:#e5e7eb;font-size:13px;min-height:80px;"></textarea>
                                        <div style="display:flex;gap:8px;margin-top:12px;justify-content:flex-end;">
                                            <button type="button" data-bs-dismiss="modal" style="background:rgba(255,255,255,0.06);color:#9ca3af;padding:8px 16px;border-radius:8px;font-size:13px;border:none;cursor:pointer;">Cancel</button>
                                            <button type="submit" style="background:rgba(239,68,68,0.8);color:white;padding:8px 16px;border-radius:8px;font-size:13px;border:none;cursor:pointer;">Reject</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;padding:40px;color:#6b7280;">
                        <i class="fas fa-check-circle" style="font-size:32px;margin-bottom:10px;display:block;color:#22c55e;"></i>
                        No profiles pending approval. All caught up!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($profiles->hasPages())
    <div style="padding:16px 0 0;display:flex;justify-content:center;">
        {{ $profiles->links() }}
    </div>
    @endif
</div>
@endsection
