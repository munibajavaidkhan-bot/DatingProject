{{-- resources/views/user/quiz-results.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Quiz Results')
@section('page-title', 'Your Love Profile')

@section('content')

{{-- Hero --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7,#6366f1);border-radius:24px;padding:40px;color:white;text-align:center;margin-bottom:28px;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-50px;left:-50px;width:200px;height:200px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-60px;right:-30px;width:160px;height:160px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>

    <div style="position:relative;z-index:1;">
        <div style="font-size:48px;margin-bottom:12px;">💕</div>
        <h2 style="font-family:'Playfair Display',serif;font-size:32px;font-weight:700;margin-bottom:8px;">
            You Are: {{ $personalityType }}
        </h2>
        <p style="opacity:0.9;font-size:15px;max-width:500px;margin:0 auto 20px;">
            Based on your {{ $answers->count() }} answers, we have uncovered your unique love personality.
        </p>
        <div style="background:rgba(255,255,255,0.2);border-radius:20px;padding:4px;display:inline-flex;gap:8px;">
            <div style="background:white;border-radius:16px;padding:8px 20px;">
                <span style="font-size:18px;font-weight:800;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                    {{ $completionPct }}%
                </span>
                <span style="font-size:12px;color:#6b7280;margin-left:4px;">Complete</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Left: Category Scores --}}
    <div class="col-lg-7">

        <div class="glass-card mb-4">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:20px;">
                <i class="fas fa-chart-radar me-2" style="color:#ec4899;"></i>
                Your Love Profile Breakdown
            </h5>

            @php
            $categoryLabels = [
                'personality'        => ['label' => 'Emotional Depth',      'icon' => 'fa-heart',          'color' => '#ec4899'],
                'values'             => ['label' => 'Core Values',           'icon' => 'fa-star',           'color' => '#a855f7'],
                'lifestyle'          => ['label' => 'Life Balance',          'icon' => 'fa-leaf',           'color' => '#22c55e'],
                'relationship_goals' => ['label' => 'Relationship Vision',   'icon' => 'fa-compass',        'color' => '#6366f1'],
                'communication'      => ['label' => 'Communication Style',   'icon' => 'fa-comments',       'color' => '#f59e0b'],
                'interests'          => ['label' => 'Shared Interests',      'icon' => 'fa-puzzle-piece',   'color' => '#f43f5e'],
            ];
            @endphp

            @foreach($categoryScores as $category => $score)
            @if(isset($categoryLabels[$category]))
            @php $info = $categoryLabels[$category]; @endphp
            <div style="margin-bottom:18px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:34px;height:34px;border-radius:10px;background:{{ $info['color'] }}22;display:flex;align-items:center;justify-content:center;">
                            <i class="fas {{ $info['icon'] }}" style="color:{{ $info['color'] }};font-size:13px;"></i>
                        </div>
                        <span style="font-weight:600;font-size:14px;color:#1f2937;">{{ $info['label'] }}</span>
                    </div>
                    <span style="font-weight:800;font-size:16px;color:{{ $info['color'] }};">{{ $score }}%</span>
                </div>
                <div style="background:#f3f4f6;border-radius:20px;height:10px;position:relative;overflow:hidden;">
                    <div style="background:{{ $info['color'] }};border-radius:20px;height:10px;width:{{ $score }}%;transition:width 1.5s ease;" class="score-bar"></div>
                </div>
                <div style="font-size:11px;color:#9ca3af;margin-top:4px;">
                    @if($score >= 80) Exceptional strength in this area
                    @elseif($score >= 60) Good foundation here
                    @elseif($score >= 40) Room for growth
                    @else Worth exploring and developing
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>

        {{-- Compatibility Tips --}}
        <div class="glass-card">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-lightbulb me-2" style="color:#f59e0b;"></i>
                Your Compatibility Insights
            </h5>

            @php
            $topCategory  = collect($categoryScores)->sortDesc()->keys()->first();
            $weakCategory = collect($categoryScores)->sort()->keys()->first();
            $tips = [
                'personality'        => ['strength' => 'You lead with your heart. Partners appreciate your emotional depth and authenticity.', 'growth' => 'Practice vulnerability without losing your identity.'],
                'values'             => ['strength' => 'Your strong values create a stable foundation for lasting love.', 'growth' => 'Stay open to partners who share your core values, even if different in style.'],
                'lifestyle'          => ['strength' => 'Your balanced lifestyle makes you adaptable and fun to be with.', 'growth' => 'Communicate your lifestyle preferences early in dating.'],
                'relationship_goals' => ['strength' => 'You know what you want — this clarity is incredibly attractive.', 'growth' => 'Allow relationships to evolve naturally toward your goals.'],
                'communication'      => ['strength' => 'You communicate openly, which builds deep trust quickly.', 'growth' => 'Listen as actively as you speak for maximum connection.'],
                'interests'          => ['strength' => 'Your varied interests make you an exciting, well-rounded partner.', 'growth' => 'Find partners who complement, not just copy, your interests.'],
            ];
            @endphp

            <div style="background:linear-gradient(135deg,#fce7f3,#f3e8ff);border-radius:16px;padding:20px;margin-bottom:16px;">
                <div style="font-weight:700;color:#ec4899;margin-bottom:8px;">
                    <i class="fas fa-star me-2"></i> Your Superpower
                </div>
                <p style="font-size:14px;color:#4b5563;margin:0;line-height:1.6;">
                    {{ $tips[$topCategory]['strength'] ?? 'You have wonderful qualities that will attract the right partner.' }}
                </p>
            </div>

            <div style="background:#f0fdf4;border-radius:16px;padding:20px;">
                <div style="font-weight:700;color:#22c55e;margin-bottom:8px;">
                    <i class="fas fa-seedling me-2"></i> Growth Opportunity
                </div>
                <p style="font-size:14px;color:#4b5563;margin:0;line-height:1.6;">
                    {{ $tips[$weakCategory]['growth'] ?? 'Focus on communicating your needs clearly and compassionately.' }}
                </p>
            </div>
        </div>
    </div>

    {{-- Right: Top Traits + CTAs --}}
    <div class="col-lg-5">

        {{-- Top Traits --}}
        <div class="glass-card mb-4">
            <h5 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-award me-2" style="color:#a855f7;"></i>
                Your Top Traits
            </h5>

            @foreach($topTraits as $trait)
            <div style="display:flex;align-items:center;gap:12px;padding:12px;border-radius:12px;background:{{ $loop->first ? 'linear-gradient(135deg,#fce7f3,#f3e8ff)' : '#f9fafb' }};margin-bottom:8px;">
                <div style="width:40px;height:40px;border-radius:12px;background:{{ $loop->first ? 'linear-gradient(135deg,#ec4899,#a855f7)' : '#e5e7eb' }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas {{ $trait['icon'] }}" style="color:{{ $loop->first ? 'white' : '#6b7280' }};font-size:15px;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:600;font-size:14px;color:#1f2937;">{{ $trait['label'] }}</div>
                    <div style="background:{{ $loop->first ? 'rgba(236,72,153,0.2)' : '#e5e7eb' }};border-radius:20px;height:4px;margin-top:6px;">
                        <div style="background:{{ $loop->first ? 'linear-gradient(90deg,#ec4899,#a855f7)' : '#9ca3af' }};border-radius:20px;height:4px;width:{{ $trait['score'] }}%;"></div>
                    </div>
                </div>
                <span style="font-weight:800;font-size:14px;color:{{ $loop->first ? '#ec4899' : '#6b7280' }};flex-shrink:0;">{{ $trait['score'] }}%</span>
            </div>
            @endforeach
        </div>

        {{-- Ideal Partner Type --}}
        <div style="background:linear-gradient(135deg,#1f2937,#374151);border-radius:20px;padding:24px;color:white;margin-bottom:16px;">
            <div style="font-size:24px;margin-bottom:12px;">🎯</div>
            <h6 style="font-weight:700;margin-bottom:8px;">Your Ideal Match</h6>
            <p style="font-size:13px;opacity:0.85;line-height:1.6;margin-bottom:16px;">
                Based on your profile, you'll connect best with someone who is
                @if(isset($categoryScores['communication']) && $categoryScores['communication'] > 60)
                    a strong communicator,
                @endif
                @if(isset($categoryScores['values']) && $categoryScores['values'] > 60)
                    values-aligned,
                @endif
                emotionally available, and ready for something meaningful.
            </p>
            <a href="{{ route('member.matches') }}" class="btn-gradient" style="width:100%;display:block;text-align:center;padding:12px;border-radius:12px;text-decoration:none;font-weight:700;">
                <i class="fas fa-heart me-2"></i> See My Matches
            </a>
        </div>

        {{-- Retake Quiz --}}
        <div class="glass-card text-center">
            <i class="fas fa-redo fa-lg mb-2 d-block" style="color:#a855f7;"></i>
            <div style="font-weight:700;font-size:14px;color:#1f2937;margin-bottom:4px;">Want to Retake?</div>
            <p style="font-size:12px;color:#6b7280;margin-bottom:12px;">Your answers can change as you grow. Retake anytime.</p>
            <a href="{{ route('member.quiz') }}" style="color:#ec4899;font-size:13px;font-weight:600;text-decoration:none;">
                Retake Quiz <i class="fas fa-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Animate score bars on load
    window.addEventListener('load', () => {
        document.querySelectorAll('.score-bar').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => { bar.style.width = width; }, 200);
        });
    });
</script>
@endpush