<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\ContentWeek;
use App\Models\UserContentProgress;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $weeks = ContentWeek::where('is_published', true)
            ->orderBy('week_number')
            ->get();

        $progress = UserContentProgress::where('user_id', $user->id)
            ->pluck('is_completed', 'content_week_id');

        $unlocked = UserContentProgress::where('user_id', $user->id)
            ->where('is_unlocked', true)
            ->pluck('is_unlocked', 'content_week_id');

        $completedCount = $progress->filter()->count();
        $currentWeek    = min($completedCount + 1, 52);

        return view('user.content', compact('weeks', 'progress', 'unlocked', 'completedCount', 'currentWeek'));
    }

    public function show(int $week)
    {
        $user    = Auth::user();
        $content = ContentWeek::where('week_number', $week)->where('is_published', true)->firstOrFail();

        $progress = UserContentProgress::where('user_id', $user->id)
            ->where('content_week_id', $content->id)->first();

        $completedCount = UserContentProgress::where('user_id', $user->id)
            ->where('is_completed', true)
            ->count();
        $currentWeek = min($completedCount + 1, 52);

        // Check access — first 4 weeks are free
        $isFreeWeek = $content->week_number <= 4;
        if ($content->is_premium && !$isFreeWeek) {
            $hasAccess = ($progress && $progress->is_unlocked) || $user->isPremium() || $content->week_number <= $currentWeek;
            if (!$hasAccess) {
                return redirect()->route('member.plans')
                    ->with('info', 'Upgrade to Premium to access Week ' . $week);
            }
        }

        // Auto-unlock if not already
        if (!$progress) {
            $progress = UserContentProgress::create([
                'user_id'        => $user->id,
                'content_week_id'=> $content->id,
                'is_unlocked'    => true,
                'unlocked_at'    => now(),
            ]);
        }

        // Prev / Next
        $prevWeek = ContentWeek::where('week_number', $week - 1)->first();
        $nextWeek = ContentWeek::where('week_number', $week + 1)->first();

        return view('user.content-show', compact('content', 'progress', 'prevWeek', 'nextWeek'));
    }

    public function complete(int $week)
    {
        $user    = Auth::user();
        $content = ContentWeek::where('week_number', $week)->firstOrFail();

        UserContentProgress::updateOrCreate(
            ['user_id' => $user->id, 'content_week_id' => $content->id],
            ['is_completed' => true, 'completed_at' => now(), 'progress_percent' => 100]
        );

        // Unlock next week
        $next = ContentWeek::where('week_number', $week + 1)->first();
        if ($next) {
            UserContentProgress::updateOrCreate(
                ['user_id' => $user->id, 'content_week_id' => $next->id],
                ['is_unlocked' => true, 'unlocked_at' => now()]
            );
        }

        return response()->json(['success' => true, 'next_week' => $next?->week_number]);
    }
}