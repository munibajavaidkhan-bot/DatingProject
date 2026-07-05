{{-- resources/views/user/dashboard.blade.php --}}
@extends('layouts.user-layout')

@section('title', 'Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

{{-- Hero Welcome Card --}}
<div style="background:linear-gradient(135deg,#ec4899,#a855f7,#6366f1);border-radius:24px;padding:32px;color:white;margin-bottom:24px;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-40px;right:-40px;width:180px;height:180px;background:rgba(255,255,255,0.08);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-60px;right:60px;width:120px;height:120px;background:rgba(255,255,255,0.05);border-radius:50%;"></div>

    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 style="font-family:'Playfair Display',serif;font-size:28px;font-weight:700;margin-bottom:8px;">
                Welcome back, {{ explode(' ', $user->name)[0] }}! 💕
            </h2>
            <p style="opacity:0.9;font-size:15px;margin-bottom:20px;">
                You're on Week <strong>{{ $currentWeekNum }}</strong> of your 52-week journey to meaningful love.
            </p>

            {{-- Progress Bar --}}
            <div style="background:rgba(255,255,255,0.2);border-radius:20px;height:10px;margin-bottom:8px;">
                <div style="background:rgba(255,255,255,0.9);border-radius:20px;height:10px;width:{{ $progressPercent }}%;transition:width 1s ease;"></div>
            </div>
            <div style="font-size:13px;opacity:0.85;">
                {{ $completedCount }} of 52 weeks completed — {{ $progressPercent }}% of your journey
            </div>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <div style="background:rgba(255,255,255,0.15);border-radius:16px;padding:16px;display:inline-block;">
                <div style="font-size:36px;font-weight:800;line-height:1;">{{ $totalMatches }}</div>
                <div style="font-size:13px;opacity:0.85;">Total Matches</div>
                <div style="font-size:11px;opacity:0.7;margin-top:4px;">{{ $acceptedMatches }} accepted</div>
            </div>
        </div>
    </div>
</div>

{{-- Stats Row --}}
<div class="row g-3 mb-4">
    @php
    $statCards = [
        ['label' => 'Matches', 'value' => $totalMatches, 'icon' => 'fa-heart', 'color' => '#ec4899', 'bg' => '#fce7f3', 'route' => 'member.matches'],
        ['label' => 'Messages', 'value' => $unreadMessages, 'icon' => 'fa-comment-dots', 'color' => '#a855f7', 'bg' => '#f3e8ff', 'route' => 'member.chat'],
        ['label' => 'Current Week', 'value' => $currentWeekNum, 'icon' => 'fa-calendar-week', 'color' => '#6366f1', 'bg' => '#eef2ff', 'route' => 'member.content'],
        ['label' => 'Quiz Status', 'value' => $quizCompleted ? '✓ Done' : $quizAnswerCount.'/29', 'icon' => 'fa-brain', 'color' => '#f59e0b', 'bg' => '#fef3c7', 'route' => 'member.quiz'],
    ];
    @endphp

    @foreach($statCards as $card)
    <div class="col-6 col-md-3">
        <a href="{{ route($card['route']) }}" style="text-decoration:none;">
            <div class="glass-card text-center" style="padding:20px;transition:transform .2s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width:48px;height:48px;background:{{ $card['bg'] }};border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                    <i class="fas {{ $card['icon'] }}" style="color:{{ $card['color'] }};font-size:20px;"></i>
                </div>
                <div style="font-size:24px;font-weight:800;color:#1f2937;">{{ $card['value'] }}</div>
                <div style="font-size:12px;color:#6b7280;font-weight:500;">{{ $card['label'] }}</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row g-4">
    {{-- Left Column --}}
    <div class="col-lg-8">

        {{-- Current Week Lesson --}}
        @if($currentWeek)
        <div class="glass-card mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <span style="background:linear-gradient(135deg,#ec4899,#a855f7);color:white;font-size:11px;font-weight:700;padding:4px 12px;border-radius:20px;text-transform:uppercase;letter-spacing:1px;">
                        Week {{ $currentWeekNum }}
                    </span>
                </div>
                @if($weekProgress?->is_completed)
                <span style="color:#22c55e;font-size:13px;font-weight:600;">
                    <i class="fas fa-check-circle me-1"></i> Completed
                </span>
                @endif
            </div>

            <h4 style="font-family:'Playfair Display',serif;font-weight:700;color:#1f2937;margin-bottom:6px;">
                {{ $currentWeek->title }}
            </h4>
            <p style="color:#6b7280;font-size:13px;margin-bottom:16px;">{{ $currentWeek->subtitle }}</p>
            <p style="color:#4b5563;font-size:14px;line-height:1.7;margin-bottom:20px;">
                {{ \Str::limit($currentWeek->description, 200) }}
            </p>

            {{-- Exercises preview --}}
            @if($currentWeek->exercises)
            <div style="background:#fdf2f8;border-radius:12px;padding:16px;margin-bottom:20px;">
                <div style="font-weight:700;font-size:13px;color:#ec4899;margin-bottom:10px;">
                    <i class="fas fa-tasks me-2"></i>This Week's Exercises
                </div>
                @foreach(array_slice($currentWeek->exercises, 0, 3) as $exercise)
                <div style="display:flex;align-items:flex-start;gap:8px;margin-bottom:6px;">
                    <i class="fas fa-circle-check" style="color:#ec4899;font-size:12px;margin-top:3px;flex-shrink:0;"></i>
                    <span style="font-size:13px;color:#4b5563;">{{ $exercise }}</span>
                </div>
                @endforeach
            </div>
            @endif

            <div class="d-flex gap-2">
                @if($weekProgress?->is_unlocked || !$currentWeek->is_premium)
                <a href="{{ route('member.content.show', $currentWeekNum) }}" class="btn-gradient" style="font-size:13px;padding:10px 20px;border-radius:10px;text-decoration:none;">
                    <i class="fas fa-book-open me-2"></i>Read Lesson
                </a>
                @else
                <a href="{{ route('member.plans') }}" class="btn-gradient" style="font-size:13px;padding:10px 20px;border-radius:10px;text-decoration:none;background:linear-gradient(135deg,#f59e0b,#ef4444);">
                    <i class="fas fa-crown me-2"></i>Unlock Premium
                </a>
                @endif

                <a href="{{ route('member.content') }}" style="font-size:13px;padding:10px 20px;border-radius:10px;color:#a855f7;border:1px solid #a855f7;text-decoration:none;font-weight:600;">
                    All Weeks
                </a>
            </div>
        </div>
        @endif

        {{-- Suggested Matches --}}
        <div class="glass-card">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 style="font-weight:700;color:#1f2937;margin:0;">
                    <i class="fas fa-heart me-2" style="color:#ec4899;"></i>
                    Suggested Matches
                </h5>
                <a href="{{ route('member.matches') }}" style="color:#ec4899;font-size:13px;font-weight:600;text-decoration:none;">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>

            @forelse($suggestedMatches as $match)
            @php $other = $match->getOtherUser($user->id); @endphp
            <div style="display:flex;align-items:center;gap:14px;padding:14px 0;border-bottom:1px solid rgba(236,72,153,0.08);" class="{{ !$loop->last ? '' : '' }}">
                <div style="position:relative;flex-shrink:0;">
                    <img src="{{ $other->getAvatarUrl() }}"
                         style="width:54px;height:54px;border-radius:50%;object-fit:cover;border:2px solid #ec4899;">
                    @if($other->profile?->is_verified)
                    <div style="position:absolute;bottom:-2px;right:-2px;width:18px;height:18px;background:#3b82f6;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-check" style="font-size:8px;color:white;"></i>
                    </div>
                    @endif
                </div>

                <div style="flex:1;min-width:0;">
                    <div style="font-weight:700;font-size:14px;color:#1f2937;">{{ $other->name }}</div>
                    <div style="font-size:12px;color:#6b7280;margin-top:2px;">
                        {{ $other->getAge() ? $other->getAge().' years' : '' }}
                        {{ $other->profile?->city ? '· '.$other->profile->city : '' }}
                    </div>
                    @if($other->profile?->personality_type)
                    <div style="font-size:11px;color:#a855f7;font-weight:600;margin-top:3px;">
                        {{ $other->profile->personality_type }}
                    </div>
                    @endif
                </div>

                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:18px;font-weight:800;background:linear-gradient(135deg,#ec4899,#a855f7);-webkit-background-clip:text;-webkit-text-fill-color:transparent;">
                        {{ $match->compatibility_score }}%
                    </div>
                    <div style="font-size:10px;color:#9ca3af;">match</div>
                </div>

                <div style="display:flex;flex-direction:column;gap:6px;">
                    <form action="{{ route('member.matches.accept', $match->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="width:32px;height:32px;border-radius:50%;background:#fce7f3;border:none;color:#ec4899;cursor:pointer;transition:all .2s;" title="Accept">
                            <i class="fas fa-heart fa-xs"></i>
                        </button>
                    </form>
                    <form action="{{ route('member.matches.reject', $match->id) }}" method="POST">
                        @csrf
                        <button type="submit" style="width:32px;height:32px;border-radius:50%;background:#f3f4f6;border:none;color:#9ca3af;cursor:pointer;transition:all .2s;" title="Pass">
                            <i class="fas fa-times fa-xs"></i>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div style="text-align:center;padding:30px;color:#9ca3af;">
                <i class="fas fa-heart-crack fa-2x mb-3"></i>
                <p style="font-size:14px;">No suggestions yet. Complete your quiz to get matched!</p>
                <a href="{{ route('member.quiz') }}" class="btn-gradient" style="font-size:13px;padding:10px 20px;border-radius:10px;text-decoration:none;display:inline-block;">
                    Take Quiz
                </a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Right Column --}}
    <div class="col-lg-4">

        {{-- Profile Card --}}
        <div class="glass-card mb-4 text-center">
            <div style="position:relative;display:inline-block;margin-bottom:16px;">
                <img src="{{ $user->getAvatarUrl() }}"
                     style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid #ec4899;">
                @if($user->profile?->is_verified)
                <div style="position:absolute;bottom:0;right:0;width:22px;height:22px;background:#3b82f6;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-check" style="font-size:9px;color:white;"></i>
                </div>
                @endif
            </div>
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:2px;">{{ $user->name }}</h6>
            <div style="font-size:12px;color:#a855f7;font-weight:600;margin-bottom:4px;">
                {{ $user->profile?->personality_type ?? 'Love Seeker' }}
            </div>
            <div style="font-size:12px;color:#6b7280;margin-bottom:16px;">
                {{ $user->profile?->city ?? '' }}
                {{ $user->getAge() ? '· ' . $user->getAge() . ' yrs' : '' }}
            </div>

            {{-- Profile completeness --}}
            @php
                $completeness = 0;
                $checks = ['first_name','gender','date_of_birth','city','bio','profile_picture','occupation','interests','relationship_goal'];
                foreach($checks as $c) { if($user->profile?->$c) $completeness++; }
                $pct = round(($completeness / count($checks)) * 100);
            @endphp
            <div style="text-align:left;margin-bottom:12px;">
                <div style="font-size:12px;color:#6b7280;margin-bottom:6px;">
                    Profile Completeness — <strong style="color:#ec4899;">{{ $pct }}%</strong>
                </div>
                <div style="background:#fce7f3;border-radius:20px;height:6px;">
                    <div style="background:linear-gradient(90deg,#ec4899,#a855f7);border-radius:20px;height:6px;width:{{ $pct }}%;"></div>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="btn-gradient w-100" style="font-size:13px;padding:10px;border-radius:10px;text-decoration:none;display:block;text-align:center;">
                <i class="fas fa-edit me-1"></i> Edit Profile
            </a>
        </div>

        {{-- Quiz CTA --}}
        @if(!$quizCompleted)
        <div style="background:linear-gradient(135deg,#f59e0b,#ef4444);border-radius:20px;padding:20px;color:white;margin-bottom:16px;">
            <i class="fas fa-brain fa-2x mb-2 d-block"></i>
            <h6 style="font-weight:700;">Complete Your Quiz</h6>
            <p style="font-size:12px;opacity:0.9;margin-bottom:12px;">
                {{ $quizAnswerCount }} of 29 questions answered. Finish to get better matches!
            </p>
            <div style="background:rgba(255,255,255,0.2);border-radius:20px;height:6px;margin-bottom:12px;">
                <div style="background:white;border-radius:20px;height:6px;width:{{ $quizAnswerCount > 0 ? round(($quizAnswerCount/29)*100) : 0 }}%;"></div>
            </div>
            <a href="{{ route('member.quiz.start') }}" style="background:white;color:#ef4444;font-size:13px;font-weight:700;padding:10px 20px;border-radius:10px;text-decoration:none;display:block;text-align:center;">
                {{ $quizAnswerCount > 0 ? 'Continue Quiz' : 'Start Quiz' }}
            </a>
        </div>
        @endif

        {{-- Notifications --}}
        <div class="glass-card">
            <h6 style="font-weight:700;color:#1f2937;margin-bottom:16px;">
                <i class="fas fa-bell me-2" style="color:#a855f7;"></i> Recent Activity
            </h6>

            @forelse($recentNotifications as $notif)
            <div style="display:flex;gap:10px;align-items:flex-start;margin-bottom:12px;{{ !$notif->is_read ? 'opacity:1' : 'opacity:0.7' }}">
                <div style="width:32px;height:32px;border-radius:50%;background:{{ $notif->color }}22;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fas {{ $notif->icon }}" style="color:{{ $notif->color }};font-size:12px;"></i>
                </div>
                <div style="min-width:0;">
                    <div style="font-size:12px;font-weight:600;color:#1f2937;">{{ $notif->title }}</div>
                    <div style="font-size:11px;color:#6b7280;margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $notif->message }}</div>
                    <div style="font-size:10px;color:#9ca3af;margin-top:2px;">{{ $notif->created_at->diffForHumans() }}</div>
                </div>
            </div>
            @empty
            <div style="text-align:center;color:#9ca3af;padding:16px;">
                <i class="fas fa-bell-slash mb-2 d-block"></i>
                <span style="font-size:12px;">No recent activity</span>
            </div>
            @endforelse

            @if($recentNotifications->count() > 0)
            <a href="{{ route('member.notifications') }}" style="display:block;text-align:center;color:#ec4899;font-size:12px;font-weight:600;margin-top:8px;text-decoration:none;">
                View all <i class="fas fa-arrow-right ms-1"></i>
            </a>
            @endif
        </div>

    </div>
</div>

@endsection