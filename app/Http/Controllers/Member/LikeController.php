<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserLike;
use App\Models\UserMatch;
use App\Models\Notification;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // ── Swipe / Discover Page ─────────────────────────────────
    public function index()
    {
        $user = Auth::user();

        // Already liked/passed user IDs
        $interactedIds = UserLike::where('sender_id', $user->id)
            ->pluck('receiver_id')
            ->toArray();

        // Add own ID
        $interactedIds[] = $user->id;

        // Get users to show (not yet interacted)
        $profiles = User::where('role', 'user')
            ->where('status', 'active')
            ->whereNotIn('id', $interactedIds)
            ->whereHas('profile', fn($q) => $q->where('is_complete', true))
            ->with('profile')
            ->inRandomOrder()
            ->take(10)
            ->get();

        // Who liked me (pending)
        $likedMe = UserLike::where('receiver_id', $user->id)
            ->where('type', '!=', 'pass')
            ->whereNotIn('sender_id', function($q) use ($user) {
                $q->select('receiver_id')
                  ->from('user_likes')
                  ->where('sender_id', $user->id);
            })
            ->with('sender.profile')
            ->latest()
            ->get();

        // My stats
        $dailyLikes = UserLike::where('sender_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        $stats = [
            'likes_sent'     => UserLike::where('sender_id', $user->id)
                                  ->where('type', 'like')->count(),
            'likes_received' => UserLike::where('receiver_id', $user->id)
                                  ->where('type', '!=', 'pass')->count(),
            'mutual_matches' => UserMatch::where(function($q) use ($user) {
                                    $q->where('user_one_id', $user->id)
                                      ->orWhere('user_two_id', $user->id);
                                })->where('status', 'accepted')->count(),
            'super_likes_left' => max(0, 3 - UserLike::where('sender_id', $user->id)
                                  ->where('type', 'super_like')
                                  ->whereDate('created_at', today())->count()),
            'daily_likes_used'  => $dailyLikes,
            'daily_likes_limit' => $user->getMatchLimit(),
            'daily_msgs_used'   => \App\Models\Message::where('sender_id', $user->id)
                                  ->whereDate('created_at', today())->count(),
            'daily_msgs_limit'  => $user->getMessageLimit(),
        ];

        return view('user.discover', compact('user', 'profiles', 'likedMe', 'stats'));
    }

    // ── Send Like ─────────────────────────────────────────────
    public function like(Request $request, int $userId)
    {
        $user     = Auth::user();
        $receiver = User::with('profile')->findOrFail($userId);
        $type     = $request->input('type', 'like'); // like or super_like

        if ($userId === $user->id) {
            return response()->json(['error' => 'Cannot like yourself'], 422);
        }

        // Check daily like limit
        $dailyLikes = UserLike::where('sender_id', $user->id)
            ->whereDate('created_at', today())
            ->count();
        $limit = $user->getMatchLimit();

        if ($dailyLikes >= $limit) {
            return response()->json([
                'error' => "You've reached your daily like limit ({$limit} likes). Upgrade for more!",
                'upgrade' => true,
                'plan_name' => $user->getCurrentPlan()?->name ?? 'Free',
                'limit' => $limit,
                'used' => $dailyLikes,
            ], 422);
        }

        // Check already liked
        $existing = UserLike::where('sender_id', $user->id)
            ->where('receiver_id', $userId)
            ->first();

        if ($existing) {
            return response()->json([
                'error'   => 'Already liked',
                'is_mutual' => $existing->is_mutual
            ], 422);
        }

        // Create like
        $like = UserLike::create([
            'sender_id'   => $user->id,
            'receiver_id' => $userId,
            'type'        => $type,
            'is_mutual'   => false,
        ]);

        // Check if receiver already liked sender (mutual!)
        $reverselike = UserLike::where('sender_id', $userId)
            ->where('receiver_id', $user->id)
            ->where('type', '!=', 'pass')
            ->first();

        if ($reverselike) {
            // ── MUTUAL MATCH! ─────────────────────────────────
            $like->update(['is_mutual' => true, 'mutual_at' => now()]);
            $reverselike->update(['is_mutual' => true, 'mutual_at' => now()]);

            // Create or update UserMatch
            $match = $this->createMutualMatch($user->id, $userId);

            // Notify BOTH users
            $this->sendMatchNotification($user, $receiver, $match);
            $this->sendMatchNotification($receiver, $user, $match);

            return response()->json([
                'success'    => true,
                'is_mutual'  => true,
                'match_id'   => $match->id,
                'chat_url'   => route('member.chat.show', $match->id),
                'message'    => "It's a Match! 🎉",
                'other_user' => [
                    'name'   => $receiver->name,
                    'avatar' => $receiver->getAvatarUrl(),
                ],
            ]);
        }

        // ── NOT MUTUAL YET — notify receiver ──────────────────
        $notifTitle   = $type === 'super_like'
            ? "⭐ {$user->name} Super Liked you!"
            : "💕 {$user->name} liked your profile!";

        $notifMessage = $type === 'super_like'
            ? "{$user->name} thinks you're exceptional! Like back to match."
            : "Check out {$user->name}'s profile and like back to match!";

        Notification::create([
            'user_id'      => $userId,
            'from_user_id' => $user->id,
            'type'         => 'new_match',
            'title'        => $notifTitle,
            'message'      => $notifMessage,
            'icon'         => $type === 'super_like' ? 'fa-star' : 'fa-heart',
            'color'        => $type === 'super_like' ? '#f59e0b' : '#ec4899',
            'action_url'   => route('member.discover'),
        ]);

        return response()->json([
            'success'   => true,
            'is_mutual' => false,
            'type'      => $type,
            'message'   => $type === 'super_like'
                ? '⭐ Super Like sent!'
                : '💕 Like sent!',
        ]);
    }

    // ── Pass / Skip ───────────────────────────────────────────
    public function pass(int $userId)
    {
        $user = Auth::user();

        UserLike::updateOrCreate(
            ['sender_id' => $user->id, 'receiver_id' => $userId],
            ['type' => 'pass']
        );

        return response()->json(['success' => true, 'message' => 'Passed']);
    }

    // ── Get Pending Likes (who liked me) ──────────────────────
    public function likedMe()
    {
        $user = Auth::user();

        $likes = UserLike::where('receiver_id', $user->id)
            ->where('type', '!=', 'pass')
            ->with('sender.profile')
            ->latest()
            ->get()
            ->map(fn($like) => [
                'id'          => $like->id,
                'sender_id'   => $like->sender_id,
                'name'        => $like->sender->name,
                'avatar'      => $like->sender->getAvatarUrl(),
                'age'         => $like->sender->getAge(),
                'city'        => $like->sender->profile?->city,
                'type'        => $like->type,
                'is_mutual'   => $like->is_mutual,
                'time'        => $like->created_at->diffForHumans(),
            ]);

        return response()->json([
            'count' => $likes->count(),
            'likes' => $likes,
        ]);
    }

    // ── Private Helpers ───────────────────────────────────────
    private function createMutualMatch(int $userOneId, int $userTwoId): UserMatch
    {
        // Consistent ordering
        $one = min($userOneId, $userTwoId);
        $two = max($userOneId, $userTwoId);

        return UserMatch::updateOrCreate(
            ['user_one_id' => $one, 'user_two_id' => $two],
            [
                'status'         => 'accepted',
                'user_one_liked' => true,
                'user_two_liked' => true,
                'matched_at'     => now(),
                'compatibility_score' => $this->quickScore($one, $two),
            ]
        );
    }

    private function quickScore(int $userOneId, int $userTwoId): int
    {
        $profileOne = Profile::where('user_id', $userOneId)->first();
        $profileTwo = Profile::where('user_id', $userTwoId)->first();

        if (!$profileOne || !$profileTwo) return 50;

        $score = 50;

        // Shared interests
        $interestsOne = $profileOne->interests ?? [];
        $interestsTwo = $profileTwo->interests ?? [];
        $shared = count(array_intersect($interestsOne, $interestsTwo));
        $total  = count(array_unique(array_merge($interestsOne, $interestsTwo)));
        if ($total > 0) {
            $score += round(($shared / $total) * 30);
        }

        // Same relationship goal
        if ($profileOne->relationship_goal &&
            $profileOne->relationship_goal === $profileTwo->relationship_goal) {
            $score += 20;
        }

        return min(100, $score);
    }

    private function sendMatchNotification(User $to, User $from, UserMatch $match): void
    {
        Notification::create([
            'user_id'      => $to->id,
            'from_user_id' => $from->id,
            'type'         => 'match_accepted',
            'title'        => "🎉 It's a Match!",
            'message'      => "You and {$from->name} liked each other! Start chatting now.",
            'icon'         => 'fa-heart',
            'color'        => '#ec4899',
            'action_url'   => route('member.chat.show', $match->id),
        ]);
    }
}