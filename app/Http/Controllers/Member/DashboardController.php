<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use App\Models\ContentWeek;
use App\Models\UserContentProgress;
use App\Models\Message;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load('profile', 'quizAnswers');

        // Redirect if profile not complete
        if (!$user->profile?->is_complete) {
            return redirect()->route('profile.complete')
                ->with('info', 'Please complete your profile to get started!');
        }

        // Current week & progress
        $completedCount  = UserContentProgress::where('user_id', $user->id)
            ->where('is_completed', true)->count();
        $currentWeekNum  = min($completedCount + 1, 52);
        $progressPercent = round(($completedCount / 52) * 100, 1);

        // Current week content
        $currentWeek = ContentWeek::where('week_number', $currentWeekNum)
            ->where('is_published', true)
            ->first();

        // Check if current week is unlocked
        $weekProgress = null;
        if ($currentWeek) {
            $weekProgress = UserContentProgress::where('user_id', $user->id)
                ->where('content_week_id', $currentWeek->id)
                ->first();
        }

        // Matches stats
        $totalMatches    = UserMatch::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)->count();
        $acceptedMatches = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)->orWhere('user_two_id', $user->id);
        })->where('status', 'accepted')->count();

        // Suggested matches (top 3)
        $suggestedMatches = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)->orWhere('user_two_id', $user->id);
        })->where('status', 'suggested')
          ->with(['userOne.profile', 'userTwo.profile'])
          ->orderByDesc('compatibility_score')
          ->take(3)
          ->get();

        // Unread messages
        $unreadMessages = Message::where('receiver_id', $user->id)
            ->where('is_read', false)->count();

        // Unread notifications
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)->count();

        // Recent notifications
        $recentNotifications = Notification::where('user_id', $user->id)
            ->with('fromUser.profile')
            ->latest()
            ->take(5)
            ->get();

        // Quiz status
        $quizCompleted   = $user->hasCompletedQuiz();
        $quizAnswerCount = $user->quizAnswers->count();

        return view('user.dashboard', compact(
            'user',
            'currentWeek',
            'weekProgress',
            'currentWeekNum',
            'progressPercent',
            'completedCount',
            'totalMatches',
            'acceptedMatches',
            'suggestedMatches',
            'unreadMessages',
            'unreadNotifications',
            'recentNotifications',
            'quizCompleted',
            'quizAnswerCount'
        ));
    }
}