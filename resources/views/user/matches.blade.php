{{-- resources/views/user/matches.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'My Matches')
@section('page-title', 'My Matches')

@section('content')

{{-- Header Stats --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:24px;padding:28px;color:white;margin-bottom:24px;">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:6px;">Your Matches 💕</h3>
            <p style="opacity:0.9;font-size:14px;margin:0;">Explore your compatibility scores and start meaningful conversations.</p>
        </div>
        <div class="col-md-5">
            <div class="row text-center mt-3 mt-md-0 g-2">
                <div class="col-4">
                    <div style="background:rgba(255,255,255,0.15);border-radius:12px;padding:12px;">
                        <div style="font-size:24px;font-weight:800;">{{ $totalMatches }}</div>
                        <div style="font-size:11px;opacity:0.85;">Total</div>
                    </div>
                </div>
                <div class="col-4">
                    <div style="background:rgba(255,255,255,0.15);border-radius:12px;padding:12px;">
                        <div style="font-size:24px;font-weight:800;">{{ $acceptedMatches }}</div>
                        <div style="font-size:11px;opacity:0.85;">Accepted</div>
                    </div>
                </div>
                <div class="col-4">
                    <div style="background:rgba(255,255,255,0.15);border-radius:12px;padding:12px;">
                        <div style="font-size:24px;font-weight:800;">{{ $pendingMatches }}</div>
                        <div style="font-size:11px;opacity:0.85;">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filters --}}
<div class="glass-card mb-4">
    <form method="GET" action="{{ route('member.matches') }}">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label style="font-size:12px;font-weight:600;color:#6b7280;margin-bottom:4px;display:block;">Search by Name</label>
                <div style="position:relative;">
                    <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:13px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search matches..."
                           style="width:100%;padding:10px 12px 10px 36px;border:1px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;" />
                </div>
            </div>
            <div class="col-md-3">
                <label style="font-size:12px;font-weight:600;color:#6b7280;margin-bottom:4px;display:block;">Min Score</label>
                <select name="min_score" style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;">
                    <option value="">Any Score</option>
                    <option value="60" {{ request('min_score') == 60 ? 'selected' : '' }}>60%+</option>
                    <option value="70" {{ request('min_score') == 70 ? 'selected' : '' }}>70%+</option>
                    <option value="80" {{ request('min_score') == 80 ? 'selected' : '' }}>80%+</option>
                    <option value="90" {{ request('min_score') == 90 ? 'selected' : '' }}>90%+</option>
                </select>
            </div>
            <div class="col-md-3">
                <label style="font-size:12px;font-weight:600;color:#6b7280;margin-bottom:4px;display:block;">Status</label>
                <select name="status" style="width:100%;padding:10px 12px;border:1px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;">
                    <option value="">All Matches</option>
                    <option value="suggested" {{ request('status') == 'suggested' ? 'selected' : '' }}>Suggested</option>
                    <option value="accepted"  {{ request('status') == 'accepted'  ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected"  {{ request('status') == 'rejected'  ? 'selected' : '' }}>Passed</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-gradient w-100" style="padding:10px;border-radius:10px;font-size:14px;">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Matches Grid --}}
<div class="row g-3">
    @forelse($matches as $match)
    @php $other = $match->getOtherUser($user->id); @endphp
    <div class="col-md-6 col-xl-4 fade-in-up">
        <div class="glass-card" style="padding:0;overflow:hidden;transition:transform .2s,box-shadow .2s;"
             onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 40px rgba(236,72,153,0.15)'"
             onmouseout="this.style.transform='translateY(0)';this.style.boxShadow=''">

            {{-- Card Header --}}
            <div style="background:linear-gradient(135deg,#fce7f3,#f3e8ff);padding:20px;position:relative;">
                {{-- Score Badge --}}
                <div style="position:absolute;top:14px;right:14px;background:white;border-radius:20px;padding:4px 12px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">
                    <span style="font-size:13px;font-weight:800;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                        {{ $match->compatibility_score }}%
                    </span>
                </div>

                {{-- Status Badge --}}
                @php
                $statusStyles = [
                    'suggested' => ['bg'=>'#fef3c7','color'=>'#92400e','label'=>'Suggested'],
                    'accepted'  => ['bg'=>'#d1fae5','color'=>'#065f46','label'=>'Matched ✓'],
                    'rejected'  => ['bg'=>'#fee2e2','color'=>'#991b1b','label'=>'Passed'],
                ];
                $s = $statusStyles[$match->status] ?? $statusStyles['suggested'];
                @endphp
                <div style="position:absolute;top:14px;left:14px;background:{{ $s['bg'] }};color:{{ $s['color'] }};font-size:11px;font-weight:700;padding:3px 10px;border-radius:20px;">
                    {{ $s['label'] }}
                </div>

                <div style="text-align:center;padding-top:10px;">
                    <div style="position:relative;display:inline-block;">
                        <img src="{{ $other->getAvatarUrl() }}"
                             style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid white;box-shadow:0 4px 12px rgba(236,72,153,0.2);">
                        @if($other->profile?->is_verified)
                        <div style="position:absolute;bottom:2px;right:2px;width:22px;height:22px;background:#3b82f6;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;">
                            <i class="fas fa-check" style="font-size:9px;color:white;"></i>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Card Body --}}
            <div style="padding:16px 20px;">
                <h6 style="font-weight:700;color:#1f2937;margin-bottom:4px;text-align:center;">{{ $other->name }}</h6>

                <div style="text-align:center;font-size:12px;color:#6b7280;margin-bottom:12px;">
                    {{ $other->getAge() ? $other->getAge().' yrs' : '' }}
                    {{ $other->profile?->city ? ' · '.$other->profile->city : '' }}
                    {{ $other->profile?->occupation ? ' · '.$other->profile->occupation : '' }}
                </div>

                @if($other->profile?->personality_type)
                <div style="text-align:center;margin-bottom:12px;">
                    <span style="background:#f3e8ff;color:#a855f7;font-size:11px;font-weight:600;padding:3px 12px;border-radius:20px;">
                        {{ $other->profile->personality_type }}
                    </span>
                </div>
                @endif

                {{-- Interests --}}
                @if($other->profile?->interests)
                <div style="display:flex;flex-wrap:wrap;gap:4px;justify-content:center;margin-bottom:14px;">
                    @foreach(array_slice($other->profile->interests, 0, 4) as $interest)
                    <span style="background:#fce7f3;color:#ec4899;font-size:10px;padding:3px 10px;border-radius:20px;font-weight:500;">
                        {{ $interest }}
                    </span>
                    @endforeach
                    @if(count($other->profile->interests) > 4)
                    <span style="background:#f3f4f6;color:#6b7280;font-size:10px;padding:3px 10px;border-radius:20px;">
                        +{{ count($other->profile->interests) - 4 }} more
                    </span>
                    @endif
                </div>
                @endif

                {{-- Score Bars --}}
                <div style="margin-bottom:16px;">
                    @foreach([
                        ['Quiz','quiz_score','#ec4899'],
                        ['Interests','interest_score','#a855f7'],
                        ['Location','location_score','#6366f1'],
                    ] as [$label,$field,$color])
                    <div style="margin-bottom:6px;">
                        <div style="display:flex;justify-content:space-between;font-size:11px;color:#6b7280;margin-bottom:3px;">
                            <span>{{ $label }}</span>
                            <span style="font-weight:600;">{{ $match->$field }}%</span>
                        </div>
                        <div style="background:#f3f4f6;border-radius:20px;height:4px;">
                            <div style="background:{{ $color }};border-radius:20px;height:4px;width:{{ $match->$field }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Action Buttons --}}
                <div style="display:flex;gap:8px;">
                    @if($match->status === 'accepted')
                    <a href="{{ route('member.chat.show', $match->id) }}"
                       class="btn-gradient" style="flex:1;text-align:center;padding:9px;border-radius:10px;font-size:13px;text-decoration:none;">
                        <i class="fas fa-comment me-1"></i> Chat
                    </a>
                    @elseif($match->status === 'suggested')
                    <form action="{{ route('member.matches.accept', $match->id) }}" method="POST" style="flex:1;">
                        @csrf
                        <button type="submit" class="btn-gradient w-100" style="padding:9px;border-radius:10px;font-size:13px;">
                            <i class="fas fa-heart me-1"></i> Accept
                        </button>
                    </form>
                    <form action="{{ route('member.matches.reject', $match->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="padding:9px 14px;border-radius:10px;font-size:13px;background:#f3f4f6;border:none;color:#6b7280;cursor:pointer;">
                            <i class="fas fa-times"></i>
                        </button>
                    </form>
                    @endif

                    <button onclick="viewProfile({{ $match->id }})"
                            style="padding:9px 14px;border-radius:10px;font-size:13px;background:#f3e8ff;border:none;color:#a855f7;cursor:pointer;">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="glass-card text-center" style="padding:60px 20px;">
            <i class="fas fa-heart-crack fa-3x mb-3" style="color:#fca5a5;"></i>
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:8px;">No matches found</h5>
            <p style="color:#6b7280;font-size:14px;margin-bottom:20px;">
                {{ request()->hasAny(['search','status','min_score']) ? 'Try adjusting your filters.' : 'Complete your quiz and profile to get matched!' }}
            </p>
            @if(!request()->hasAny(['search','status','min_score']))
            <a href="{{ route('member.quiz.start') }}" class="btn-gradient" style="text-decoration:none;padding:12px 28px;border-radius:12px;">
                Take the Love Quiz
            </a>
            @else
            <a href="{{ route('member.matches') }}" style="color:#ec4899;text-decoration:none;font-weight:600;">
                Clear Filters
            </a>
            @endif
        </div>
    </div>
    @endforelse
</div>

{{-- Pagination --}}
@if($matches->hasPages())
<div style="margin-top:24px;display:flex;justify-content:center;">
    {{ $matches->withQueryString()->links() }}
</div>
@endif

{{-- View Profile Modal --}}
<div id="profileModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:9999;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:24px;width:90%;max-width:480px;overflow:hidden;animation:fadeInUp .3s ease;">
        <div id="modalContent" style="padding:0;">
            <div style="text-align:center;padding:40px;color:#9ca3af;">
                <i class="fas fa-spinner fa-spin fa-2x mb-3 d-block" style="color:#ec4899;"></i>
                Loading profile...
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
async function viewProfile(matchId) {
    const modal = document.getElementById('profileModal');
    modal.style.display = 'flex';

    try {
        const res  = await fetch(`/member/matches/${matchId}/profile`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await res.json();

        document.getElementById('modalContent').innerHTML = `
            <div style="background:linear-gradient(135deg,#fce7f3,#f3e8ff);padding:30px;text-align:center;position:relative;">
                <button onclick="closeModal()" style="position:absolute;top:14px;right:14px;background:white;border:none;width:32px;height:32px;border-radius:50%;cursor:pointer;font-size:16px;color:#6b7280;">×</button>
                <img src="${data.avatar}" style="width:90px;height:90px;border-radius:50%;object-fit:cover;border:3px solid white;box-shadow:0 4px 12px rgba(236,72,153,0.2);" />
                <h4 style="font-family:'Playfair Display',serif;font-weight:700;margin:12px 0 4px;">${data.name}</h4>
                <p style="color:#6b7280;font-size:13px;">${data.age ? data.age+' yrs' : ''} ${data.location ? '· '+data.location : ''}</p>
                ${data.is_verified ? '<span style="background:#dbeafe;color:#1e40af;font-size:11px;padding:3px 10px;border-radius:20px;font-weight:600;"><i class="fas fa-check me-1"></i>Verified</span>' : ''}
            </div>
            <div style="padding:20px;">
                ${data.personality_type ? `<div style="text-align:center;margin-bottom:16px;"><span style="background:#f3e8ff;color:#a855f7;padding:4px 14px;border-radius:20px;font-size:12px;font-weight:600;">${data.personality_type}</span></div>` : ''}
                ${data.bio ? `<p style="font-size:14px;color:#4b5563;line-height:1.6;margin-bottom:16px;">${data.bio}</p>` : ''}
                <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:16px;">
                    ${data.occupation ? `<span style="background:#fce7f3;color:#ec4899;font-size:12px;padding:4px 12px;border-radius:20px;"><i class="fas fa-briefcase me-1"></i>${data.occupation}</span>` : ''}
                    ${data.relationship_goal ? `<span style="background:#f3e8ff;color:#a855f7;font-size:12px;padding:4px 12px;border-radius:20px;"><i class="fas fa-heart me-1"></i>${data.relationship_goal.replace('_',' ')}</span>` : ''}
                </div>
                ${data.interests.length > 0 ? `
                <div style="display:flex;flex-wrap:wrap;gap:6px;margin-bottom:16px;">
                    ${data.interests.slice(0,6).map(i => `<span style="background:#f3f4f6;color:#6b7280;font-size:11px;padding:4px 12px;border-radius:20px;">${i}</span>`).join('')}
                </div>` : ''}
                <div style="background:#fdf2f8;border-radius:12px;padding:12px;text-align:center;">
                    <span style="font-size:20px;font-weight:800;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">${data.score}% Match</span>
                </div>
            </div>
        `;
    } catch(e) {
        document.getElementById('modalContent').innerHTML = '<div style="padding:20px;text-align:center;color:red;">Failed to load profile.</div>';
    }
}

function closeModal() {
    document.getElementById('profileModal').style.display = 'none';
}

document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>
@endpush