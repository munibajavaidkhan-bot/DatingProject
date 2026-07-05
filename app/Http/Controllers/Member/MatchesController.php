<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)
              ->orWhere('user_two_id', $user->id);
        })->with(['userOne.profile', 'userTwo.profile']);

        // Filter by status
        if ($request->status && in_array($request->status, ['suggested', 'accepted', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Filter by score
        if ($request->min_score) {
            $query->where('compatibility_score', '>=', $request->min_score);
        }

        // Search by name
        if ($request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($user, $search) {
                $q->whereHas('userOne', function ($sq) use ($user, $search) {
                    $sq->where('id', '!=', $user->id)->where('name', 'like', "%{$search}%");
                })->orWhereHas('userTwo', function ($sq) use ($user, $search) {
                    $sq->where('id', '!=', $user->id)->where('name', 'like', "%{$search}%");
                });
            });
        }

        $matches = $query->orderByDesc('compatibility_score')->paginate(10);

        // Stats
        $totalMatches    = UserMatch::where('user_one_id', $user->id)
            ->orWhere('user_two_id', $user->id)->count();
        $acceptedMatches = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)->orWhere('user_two_id', $user->id);
        })->where('status', 'accepted')->count();
        $pendingMatches = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)->orWhere('user_two_id', $user->id);
        })->where('status', 'suggested')->count();

        return view('user.matches', compact(
            'user', 'matches', 'totalMatches', 'acceptedMatches', 'pendingMatches'
        ));
    }

    public function accept(int $id)
    {
        $user  = Auth::user();
        $match = UserMatch::findOrFail($id);

        $this->authorizeMatch($match, $user->id);

        // Update like fields
        if ($match->user_one_id === $user->id) {
            $match->user_one_liked = true;
        } else {
            $match->user_two_liked = true;
        }

        // If both liked → it's a mutual match
        if ($match->user_one_liked && $match->user_two_liked) {
            $match->status     = 'accepted';
            $match->matched_at = now();

            // Notify both
            $other = $match->getOtherUser($user->id);
            $this->createNotification($other->id, $user->id, 'match_accepted',
                'It\'s a Match! 🎉',
                "{$user->name} accepted your match! Start chatting now.",
                route('member.chat.show', $match->id)
            );
            $this->createNotification($user->id, $other->id, 'match_accepted',
                'It\'s a Match! 🎉',
                "You and {$other->name} are now matched! Start chatting.",
                route('member.chat.show', $match->id)
            );
        } else {
            $match->status = 'suggested'; // still waiting
            // Notify the other user someone liked them
            $other = $match->getOtherUser($user->id);
            $this->createNotification($other->id, $user->id, 'new_match',
                'Someone liked you! 💕',
                "{$user->name} is interested in you. Check your matches!",
                route('member.matches')
            );
        }

        $match->save();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'status'  => $match->status,
                'message' => $match->status === 'accepted' ? "It's a match! 🎉" : 'Match accepted!'
            ]);
        }

        return back()->with('success', $match->status === 'accepted' ? "It's a Match! 🎉" : 'Liked!');
    }

    public function reject(int $id)
    {
        $user  = Auth::user();
        $match = UserMatch::findOrFail($id);

        $this->authorizeMatch($match, $user->id);

        $match->update(['status' => 'rejected', 'action_by' => $user->id === $match->user_one_id ? 'user_one' : 'user_two']);

        if (request()->ajax()) {
            return response()->json(['success' => true, 'message' => 'Passed.']);
        }

        return back()->with('info', 'Match passed.');
    }

    public function viewProfile(int $id)
    {
        $user  = Auth::user();
        $match = UserMatch::with(['userOne.profile', 'userTwo.profile'])->findOrFail($id);

        $this->authorizeMatch($match, $user->id);

        $profileUser = $match->getOtherUser($user->id);
        $profileUser->load('profile');

        // Increment views
        $profileUser->profile?->increment('profile_views');

        if (request()->ajax()) {
            return response()->json([
                'name'             => $profileUser->name,
                'age'              => $profileUser->getAge(),
                'location'         => $profileUser->profile?->location,
                'bio'              => $profileUser->profile?->bio,
                'occupation'       => $profileUser->profile?->occupation,
                'education'        => $profileUser->profile?->education,
                'interests'        => $profileUser->profile?->interests ?? [],
                'relationship_goal'=> $profileUser->profile?->relationship_goal,
                'avatar'           => $profileUser->getAvatarUrl(),
                'score'            => $match->compatibility_score,
                'is_verified'      => $profileUser->profile?->is_verified,
                'personality_type' => $profileUser->profile?->personality_type,
            ]);
        }

        return view('profile.updateuserprofile', compact('profileUser', 'match'));
    }

    private function authorizeMatch(UserMatch $match, int $userId): void
    {
        if ($match->user_one_id !== $userId && $match->user_two_id !== $userId) {
            abort(403, 'Unauthorized');
        }
    }

    private function createNotification(int $toUserId, int $fromUserId, string $type, string $title, string $message, string $url): void
    {
        Notification::create([
            'user_id'      => $toUserId,
            'from_user_id' => $fromUserId,
            'type'         => $type,
            'title'        => $title,
            'message'      => $message,
            'icon'         => $type === 'match_accepted' ? 'fa-heart' : 'fa-star',
            'color'        => '#ec4899',
            'action_url'   => $url,
        ]);
    }
}