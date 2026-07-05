{{-- resources/views/user/quiz-welcome.blade.php --}}
@extends('layouts.user-layout')
@section('title', 'Love Quiz')
@section('page-title', 'Love Quiz')

@section('content')
<div style="max-width:700px;margin:0 auto;">

    <div style="background:linear-gradient(135deg,#ec4899,#a855f7,#6366f1);border-radius:28px;padding:48px 40px;color:white;text-align:center;margin-bottom:28px;">
        <div style="font-size:56px;margin-bottom:16px;">🧠</div>
        <h2 style="font-family:'Playfair Display',serif;font-size:30px;font-weight:700;margin-bottom:10px;">The Love Personality Quiz</h2>
        <p style="opacity:0.9;font-size:15px;max-width:440px;margin:0 auto 28px;line-height:1.7;">
            29 science-backed questions across 6 categories. Discover your personality type and get intelligently matched.
        </p>

        @if($answeredCount > 0 && !$isCompleted)
        <div style="background:rgba(255,255,255,0.15);border-radius:16px;padding:16px;margin-bottom:20px;">
            <div style="font-size:13px;opacity:0.85;margin-bottom:8px;">Quiz in progress</div>
            <div style="background:rgba(255,255,255,0.2);border-radius:20px;height:8px;margin-bottom:6px;">
                <div style="background:white;border-radius:20px;height:8px;width:{{ round(($answeredCount/$totalCount)*100) }}%;"></div>
            </div>
            <div style="font-size:13px;opacity:0.85;">{{ $answeredCount }} of {{ $totalCount }} answered</div>
        </div>
        @endif

        @if($isCompleted)
        <div style="background:rgba(34,197,94,0.2);border-radius:14px;padding:14px;margin-bottom:20px;">
            <i class="fas fa-check-circle me-2"></i>Quiz completed!
        </div>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('member.quiz.results') }}"
               style="background:white;color:#ec4899;padding:14px 28px;border-radius:14px;font-weight:700;font-size:15px;text-decoration:none;">
                <i class="fas fa-chart-bar me-2"></i>View My Results
            </a>
            <a href="{{ route('member.quiz.start') }}"
               style="background:rgba(255,255,255,0.2);color:white;padding:14px 24px;border-radius:14px;font-weight:600;font-size:14px;text-decoration:none;">
                Retake Quiz
            </a>
        </div>
        @else
        <a href="{{ route('member.quiz.start') }}"
           style="background:white;color:#ec4899;padding:15px 36px;border-radius:14px;font-weight:800;font-size:16px;text-decoration:none;display:inline-block;box-shadow:0 4px 20px rgba(0,0,0,0.2);">
            <i class="fas fa-play me-2"></i>
            {{ $answeredCount > 0 ? 'Continue Quiz' : 'Start Quiz' }}
        </a>
        @endif
    </div>

    {{-- Categories --}}
    <div class="row g-3">
        @foreach([
            ['personality','Personality','fa-heart','#ec4899','6 questions about who you are'],
            ['values','Values','fa-star','#a855f7','5 questions about what matters to you'],
            ['lifestyle','Lifestyle','fa-leaf','#22c55e','5 questions about how you live'],
            ['relationship_goals','Goals','fa-compass','#6366f1','5 questions about what you seek'],
            ['communication','Communication','fa-comments','#f59e0b','4 questions about how you connect'],
            ['interests','Interests','fa-puzzle-piece','#f43f5e','4 questions about your passions'],
        ] as [$cat,$label,$icon,$color,$desc])
        <div class="col-md-6">
            <div class="glass-card" style="padding:18px;">
                <div style="display:flex;align-items:center;gap:12px;">
                    <div style="width:40px;height:40px;border-radius:12px;background:{{ $color }}22;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas {{ $icon }}" style="color:{{ $color }};font-size:16px;"></i>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:14px;color:#1f2937;">{{ $label }}</div>
                        <div style="font-size:12px;color:#9ca3af;">{{ $desc }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection