{{-- resources/views/user/content.blade.php --}}
@extends('layouts.user-layout')

@section('title', '52-Week Journey')
@section('page-title', '52-Week Journey')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7,#6366f1);border-radius:24px;padding:32px;color:white;margin-bottom:28px;">
    <div class="row align-items-center">
        <div class="col-md-7">
            <h3 style="font-family:'Playfair Display',serif;font-weight:700;margin-bottom:8px;">
                Your 52-Week Love Journey 📚
            </h3>
            <p style="opacity:0.9;font-size:14px;margin-bottom:20px;">
                One lesson per week. Transform how you love, connect, and communicate.
            </p>
            <div style="background:rgba(255,255,255,0.2);border-radius:20px;height:10px;margin-bottom:6px;">
                <div style="background:white;border-radius:20px;height:10px;width:{{ round(($completedCount/52)*100) }}%;transition:width 1s;"></div>
            </div>
            <div style="font-size:13px;opacity:0.85;">{{ $completedCount }}/52 completed — {{ round(($completedCount/52)*100) }}%</div>
        </div>
        <div class="col-md-5 text-md-end mt-3 mt-md-0">
            <a href="{{ route('member.content.show', $currentWeek) }}"
               style="background:white;color:#ec4899;font-size:14px;font-weight:700;padding:14px 28px;border-radius:14px;text-decoration:none;display:inline-block;box-shadow:0 4px 14px rgba(0,0,0,0.15);">
                <i class="fas fa-play me-2"></i>Continue Week {{ $currentWeek }}
            </a>
        </div>
    </div>
</div>

{{-- Category Filter --}}
@php
$categories = [
    'all'                    => ['label' => 'All Weeks',     'color' => '#ec4899'],
    'self_discovery'         => ['label' => 'Self Discovery','color' => '#a855f7'],
    'communication'          => ['label' => 'Communication', 'color' => '#6366f1'],
    'emotional_intelligence' => ['label' => 'Emotional IQ',  'color' => '#f59e0b'],
    'intimacy'               => ['label' => 'Intimacy',      'color' => '#f43f5e'],
    'trust_building'         => ['label' => 'Trust',         'color' => '#22c55e'],
];
@endphp

<div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:24px;" id="filterBtns">
    @foreach($categories as $key => $cat)
    <button onclick="filterWeeks('{{ $key }}')"
            data-filter="{{ $key }}"
            style="padding:8px 18px;border-radius:25px;border:1.5px solid #e5e7eb;background:white;color:#6b7280;font-size:13px;font-weight:600;cursor:pointer;transition:all .2s;">
        {{ $cat['label'] }}
    </button>
    @endforeach
</div>

{{-- Weeks Grid --}}
<div class="row g-3" id="weeksGrid">
    @foreach($weeks as $week)
    @php
    $isCompleted = (bool) ($progress[$week->id] ?? false);
    $isUnlocked  = (bool) ($unlocked[$week->id] ?? false);
    $isCurrent   = $week->week_number === $currentWeek;
    $isFreeWeek  = $week->week_number <= 4;
    $isLocked    = !$isFreeWeek
        && !$isUnlocked
        && !$isCompleted
        && $week->week_number > $currentWeek
        && !auth()->user()->isPremium();
    @endphp

    <div class="col-md-6 col-xl-4 week-card" data-category="{{ $week->category }}">
        <div class="week-card-inner {{ $isLocked ? 'is-locked' : '' }}"
             style="background:{{ $isCompleted ? 'linear-gradient(135deg,#d1fae5,#a7f3d0)' : ($isCurrent ? 'linear-gradient(135deg,#fce7f3,#f3e8ff)' : 'rgba(255,255,255,0.85)') }};
                    backdrop-filter:blur(16px);
                    border-radius:18px;
                    border:1.5px solid {{ $isCompleted ? '#6ee7b7' : ($isCurrent ? '#ec4899' : 'rgba(255,255,255,0.5)') }};
                    padding:20px;
                    transition:transform .2s,box-shadow .2s;
                    {{ $isLocked ? 'opacity:0.6;' : '' }}">

            <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:12px;">
                <div style="background:{{ $isCompleted ? '#22c55e' : ($isCurrent ? 'linear-gradient(135deg,#ec4899,#a855f7)' : '#f3f4f6') }};
                            color:{{ $isCompleted || $isCurrent ? 'white' : '#6b7280' }};
                            width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;
                            font-size:13px;font-weight:800;flex-shrink:0;">
                    @if($isCompleted)
                        <i class="fas fa-check" style="font-size:14px;"></i>
                    @elseif($isLocked)
                        <i class="fas fa-lock" style="font-size:12px;"></i>
                    @else
                        {{ $week->week_number }}
                    @endif
                </div>

                @if($isCurrent)
                <span style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;">
                    Current
                </span>
                @elseif($week->is_premium && !$isUnlocked)
                <span style="background:#fef3c7;color:#92400e;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;">
                    <i class="fas fa-crown me-1"></i>Premium
                </span>
                @endif
            </div>

            <h6 style="font-weight:700;color:#1f2937;margin-bottom:4px;font-size:14px;">{{ $week->title }}</h6>
            <p style="font-size:12px;color:#6b7280;margin-bottom:12px;line-height:1.5;">{{ Str::limit($week->description, 80) }}</p>

            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div style="font-size:11px;color:#9ca3af;">
                    <i class="fas fa-clock me-1"></i>{{ $week->estimated_minutes }} min
                </div>

                @if($isCompleted)
                <span style="color:#22c55e;font-size:12px;font-weight:600;">
                    <i class="fas fa-check-circle me-1"></i>Done
                </span>
                @elseif(!$isLocked)
                <a href="{{ route('member.content.show', $week->week_number) }}"
                   style="color:#ec4899;font-size:12px;font-weight:700;text-decoration:none;">
                    {{ $isCurrent ? 'Start →' : 'Read →' }}
                </a>
                @else
                <span style="color:#9ca3af;font-size:12px;">
                    <i class="fas fa-lock me-1"></i>Locked
                </span>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection

@push('styles')
<style>
.week-card-inner:not(.is-locked):hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(236,72,153,0.12);
}
</style>
@endpush

@push('scripts')
<script>
function filterWeeks(category) {
    document.querySelectorAll('#filterBtns button').forEach(btn => {
        const isActive = btn.dataset.filter === category;
        btn.style.background   = isActive ? 'linear-gradient(135deg,#ec4899,#a855f7)' : 'white';
        btn.style.color        = isActive ? 'white' : '#6b7280';
        btn.style.borderColor  = isActive ? 'transparent' : '#e5e7eb';
    });

    document.querySelectorAll('.week-card').forEach(card => {
        const show = category === 'all' || card.dataset.category === category;
        card.style.display = show ? 'block' : 'none';
    });
}
</script>
@endpush