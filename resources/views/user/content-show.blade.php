{{-- resources/views/user/content-show.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Week ' . $content->week_number . ': ' . $content->title)
@section('page-title', '52-Week Journey')

@section('content')

<div class="row g-4">
    <div class="col-lg-8">

        {{-- Lesson Header --}}
        <div style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:24px;padding:32px;color:white;margin-bottom:24px;">
            <div style="margin-bottom:12px;">
                <span style="background:rgba(255,255,255,0.2);font-size:12px;font-weight:700;padding:4px 14px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;">
                    Week {{ $content->week_number }} of 52
                </span>
            </div>
            <h2 style="font-family:'Playfair Display',serif;font-size:26px;font-weight:700;margin-bottom:8px;">
                {{ $content->title }}
            </h2>
            <p style="opacity:0.9;font-size:14px;margin-bottom:20px;">{{ $content->subtitle }}</p>
            <div style="display:flex;gap:16px;font-size:13px;opacity:0.85;">
                <span><i class="fas fa-clock me-1"></i>{{ $content->estimated_minutes }} min read</span>
                <span><i class="fas fa-tag me-1"></i>{{ ucfirst(str_replace('_',' ',$content->category)) }}</span>
                @if($progress?->is_completed)
                <span><i class="fas fa-check-circle me-1"></i>Completed</span>
                @endif
            </div>
        </div>

        {{-- Lesson Content --}}
        <div class="glass-card mb-4">
            <div style="font-size:15px;color:#374151;line-height:1.85;">
                {!! $content->content !!}
            </div>
        </div>

        {{-- Exercises --}}
        @if($content->exercises)
        <div class="glass-card mb-4">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-tasks me-2" style="color:#ec4899;"></i>This Week's Exercises
            </h5>
            @foreach($content->exercises as $i => $exercise)
            <div style="display:flex;gap:14px;align-items:flex-start;padding:14px;background:{{ $i % 2 === 0 ? '#fdf2f8' : 'white' }};border-radius:12px;margin-bottom:8px;">
                <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-weight:700;font-size:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    {{ $i + 1 }}
                </div>
                <p style="margin:0;font-size:14px;color:#374151;line-height:1.6;padding-top:4px;">{{ $exercise }}</p>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Reflection Questions --}}
        @if($content->reflection_questions)
        <div class="glass-card mb-4">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-journal-whills me-2" style="color:#a855f7;"></i>Journal Prompts
            </h5>
            @foreach($content->reflection_questions as $q)
            <div style="display:flex;gap:12px;align-items:flex-start;padding:14px 0;border-bottom:1px solid rgba(236,72,153,0.06);">
                <i class="fas fa-feather" style="color:#a855f7;font-size:14px;margin-top:3px;flex-shrink:0;"></i>
                <p style="margin:0;font-size:14px;color:#374151;line-height:1.6;font-style:italic;">{{ $q }}</p>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Complete Button --}}
        @if(!$progress?->is_completed)
        <div class="glass-card text-center" style="padding:30px;">
            <i class="fas fa-check-circle fa-2x mb-3 d-block" style="color:#22c55e;"></i>
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:6px;">Ready to mark this week complete?</h6>
            <p style="font-size:13px;color:#6b7280;margin-bottom:16px;">Only mark it complete when you have read and reflected on the lesson.</p>
            <button onclick="markComplete({{ $content->week_number }})"
                    style="background:linear-gradient(135deg,#22c55e,#16a34a);color:white;border:none;border-radius:14px;padding:14px 32px;font-size:15px;font-weight:700;cursor:pointer;box-shadow:0 4px 14px rgba(34,197,94,0.3);"
                    id="completeBtn">
                <i class="fas fa-check me-2"></i>Mark Week {{ $content->week_number }} Complete!
            </button>
        </div>
        @else
        <div style="background:linear-gradient(135deg,#d1fae5,#a7f3d0);border-radius:20px;padding:24px;text-align:center;border:1px solid #6ee7b7;">
            <i class="fas fa-check-circle fa-2x mb-2 d-block" style="color:#22c55e;"></i>
            <h6 style="font-weight:700;color:#065f46;">Week {{ $content->week_number }} Completed! 🎉</h6>
            <p style="font-size:13px;color:#065f46;opacity:0.8;margin-bottom:0;">Completed {{ $progress->completed_at?->format('M d, Y') }}</p>
        </div>
        @endif

        {{-- Prev/Next Navigation --}}
        <div style="display:flex;justify-content:space-between;margin-top:20px;gap:12px;">
            @if($prevWeek)
            <a href="{{ route('member.content.show', $prevWeek->week_number) }}"
               style="background:white;border:1.5px solid #e5e7eb;border-radius:14px;padding:14px 20px;text-decoration:none;display:flex;align-items:center;gap:10px;flex:1;color:#6b7280;font-size:13px;font-weight:600;transition:border-color .2s;"
               onmouseover="this.style.borderColor='#ec4899'" onmouseout="this.style.borderColor='#e5e7eb'">
                <i class="fas fa-arrow-left" style="color:#ec4899;"></i>
                <div>
                    <div style="font-size:11px;opacity:0.7;margin-bottom:2px;">Previous</div>
                    <div style="color:#1f2937;">Week {{ $prevWeek->week_number }}</div>
                </div>
            </a>
            @else
            <div style="flex:1;"></div>
            @endif

            @if($nextWeek)
            <a href="{{ route('member.content.show', $nextWeek->week_number) }}"
               style="background:linear-gradient(135deg,#ec4899,#a855f7);border-radius:14px;padding:14px 20px;text-decoration:none;display:flex;align-items:center;justify-content:flex-end;gap:10px;flex:1;color:white;font-size:13px;font-weight:600;"
               id="nextWeekLink">
                <div style="text-align:right;">
                    <div style="font-size:11px;opacity:0.8;margin-bottom:2px;">Next</div>
                    <div>Week {{ $nextWeek->week_number }}</div>
                </div>
                <i class="fas fa-arrow-right"></i>
            </a>
            @endif
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">

        {{-- Affirmations --}}
        @if($content->affirmations)
        <div class="glass-card mb-4">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:14px;">
                <i class="fas fa-sun me-2" style="color:#f59e0b;"></i>Daily Affirmations
            </h6>
            @foreach($content->affirmations as $affirmation)
            <div style="background:linear-gradient(135deg,#fef3c7,#fde68a);border-radius:12px;padding:12px 14px;margin-bottom:8px;font-size:13px;color:#78350f;font-style:italic;line-height:1.5;">
                "{{ $affirmation }}"
            </div>
            @endforeach
        </div>
        @endif

        {{-- Progress --}}
        <div class="glass-card mb-4">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:14px;">
                <i class="fas fa-chart-line me-2" style="color:#ec4899;"></i>Your Journey
            </h6>
            <div style="text-align:center;margin-bottom:14px;">
                <div style="font-size:36px;font-weight:800;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                    {{ $content->week_number }}/52
                </div>
                <div style="font-size:12px;color:#9ca3af;">Weeks in Journey</div>
            </div>
            <div style="background:#fce7f3;border-radius:20px;height:8px;">
                <div style="background:linear-gradient(90deg,#ec4899,#a855f7);border-radius:20px;height:8px;width:{{ round(($content->week_number/52)*100) }}%;"></div>
            </div>
            <div style="text-align:center;font-size:12px;color:#9ca3af;margin-top:6px;">{{ round(($content->week_number/52)*100) }}% of journey</div>
        </div>

        {{-- Category Badge --}}
        <div style="background:linear-gradient(135deg,#fce7f3,#f3e8ff);border-radius:20px;padding:20px;text-align:center;">
            <div style="font-size:32px;margin-bottom:10px;">📖</div>
            <div style="font-weight:700;color:#1f2937;margin-bottom:4px;">{{ ucfirst(str_replace('_',' ',$content->category)) }}</div>
            <div style="font-size:12px;color:#6b7280;">This Week's Theme</div>
            <a href="{{ route('member.content') }}" style="display:inline-block;margin-top:14px;color:#ec4899;font-size:13px;font-weight:600;text-decoration:none;">
                ← All Weeks
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
async function markComplete(weekNumber) {
    const btn = document.getElementById('completeBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Saving...';

    const res  = await fetch(`/member/content/${weekNumber}/complete`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
    });
    const data = await res.json();

    if (data.success) {
        btn.innerHTML = '<i class="fas fa-check me-2"></i>Completed! 🎉';
        btn.style.background = 'linear-gradient(135deg,#22c55e,#16a34a)';
        setTimeout(() => {
            if (data.next_week) {
                window.location = `/member/content/${data.next_week}`;
            } else {
                window.location.reload();
            }
        }, 1500);
    }
}
</script>
@endpush