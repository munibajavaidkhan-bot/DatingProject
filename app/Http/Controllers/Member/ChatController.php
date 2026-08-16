<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use App\Models\Message;
use App\Models\Notification;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all accepted matches
        $matches = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)
              ->orWhere('user_two_id', $user->id);
        })->where('status', 'accepted')
          ->with(['userOne.profile', 'userTwo.profile'])
          ->orderByDesc('last_message_at')
          ->get();

        // Add last message and unread count to each match
        $conversations = $matches->map(function ($match) use ($user) {
            $match->last_message = Message::where('match_id', $match->id)
                ->latest()->first();
            $match->unread_count = Message::where('match_id', $match->id)
                ->where('receiver_id', $user->id)
                ->where('is_read', false)->count();
            $match->other_user = $match->getOtherUser($user->id);
            return $match;
        });

        $totalUnread = Message::where('receiver_id', $user->id)
            ->where('is_read', false)->count();

        // Default values jab koi conversation select nahi
        $activeMatch  = null;
        $otherUser    = null;
        $messages     = collect();
        $receiver     = null;

        return view('user.chat', compact(
            'user',
            'conversations',
            'totalUnread',
            'activeMatch',
            'otherUser',
            'messages',
            'receiver'
        ));
    }

    public function acceptSafetyDisclaimer()
    {
        Auth::user()->update(['safety_disclaimer_accepted' => true]);
        return response()->json(['success' => true]);
    }

    public function show(int $matchId)
    {
        $user  = Auth::user();
        $match = UserMatch::findOrFail($matchId);

        // Verify user belongs to this match
        if ($match->user_one_id !== $user->id && $match->user_two_id !== $user->id) {
            abort(403);
        }

        // Must be accepted
        if ($match->status !== 'accepted') {
            return redirect()->route('member.matches')
                ->with('info', 'You can only chat with accepted matches.');
        }

        $otherUser = $match->getOtherUser($user->id);
        $otherUser->load('profile');
        $receiver  = $otherUser; // ← receiver set karo

        // Load messages
        $messages = Message::where('match_id', $matchId)
            ->where(function ($q) use ($user) {
                $q->where(function ($sq) use ($user) {
                    $sq->where('sender_id', $user->id)
                       ->where('is_deleted_by_sender', false);
                })->orWhere(function ($sq) use ($user) {
                    $sq->where('receiver_id', $user->id)
                       ->where('is_deleted_by_receiver', false);
                });
            })
            ->with(['sender.profile', 'receiver.profile'])
            ->orderBy('created_at')
            ->get();

        // Mark messages as read
        Message::where('match_id', $matchId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        // Conversation list (sidebar)
        $conversations = UserMatch::where(function ($q) use ($user) {
            $q->where('user_one_id', $user->id)
              ->orWhere('user_two_id', $user->id);
        })->where('status', 'accepted')
          ->with(['userOne.profile', 'userTwo.profile'])
          ->orderByDesc('last_message_at')
          ->get()
          ->map(function ($m) use ($user) {
              $m->last_message  = Message::where('match_id', $m->id)->latest()->first();
              $m->unread_count  = Message::where('match_id', $m->id)
                  ->where('receiver_id', $user->id)
                  ->where('is_read', false)->count();
              $m->other_user    = $m->getOtherUser($user->id);
              return $m;
          });

        $totalUnread = Message::where('receiver_id', $user->id)
            ->where('is_read', false)->count();

        $activeMatch = $match;

        return view('user.chat', compact(
            'user',
            'conversations',
            'totalUnread',
            'activeMatch',
            'otherUser',
            'messages',
            'receiver'
        ));
    }

    public function send(Request $request, int $matchId)
    {
        $request->validate(['body' => ['required', 'string', 'max:2000']]);

        $user  = Auth::user();
        $match = UserMatch::findOrFail($matchId);

        if ($match->user_one_id !== $user->id && $match->user_two_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if ($match->status !== 'accepted') {
            return response()->json(['error' => 'Match not accepted'], 422);
        }

        // Check daily message limit
        if ($user->hasExceededDailyMessages()) {
            $plan = $user->getCurrentPlan();
            $limit = $user->getMessageLimit();
            return response()->json([
                'error' => "You've reached your daily message limit ({$limit} messages).",
                'upgrade' => true,
                'plan_name' => $plan?->name ?? 'Free',
            ], 422);
        }

        $receiverId = $match->user_one_id === $user->id
            ? $match->user_two_id
            : $match->user_one_id;

        $message = Message::create([
            'sender_id'   => $user->id,
            'receiver_id' => $receiverId,
            'match_id'    => $matchId,
            'body'        => $request->body,
            'type'        => 'text',
        ]);

        // Update last message timestamp
        $match->update(['last_message_at' => now()]);

        // Load relationships for response
        $message->load('sender.profile');

        // Broadcast via Reverb
        try {
            broadcast(new MessageSent($message))->toOthers();
        } catch (\Exception $e) {
            // Reverb not running — fallback to polling
        }

        // Send notification
        Notification::create([
            'user_id'      => $receiverId,
            'from_user_id' => $user->id,
            'type'         => 'new_message',
            'title'        => 'New Message 💬',
            'message'      => "{$user->name}: " . \Str::limit($request->body, 60),
            'icon'         => 'fa-comment',
            'color'        => '#a855f7',
            'action_url'   => route('member.chat.show', $matchId),
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id'         => $message->id,
                'body'       => $message->body,
                'sender_id'  => $user->id,
                'is_read'    => false,
                'created_at' => $message->created_at->format('H:i'),
                'date'       => $message->created_at->diffForHumans(),
                'avatar'     => $user->getAvatarUrl(),
                'name'       => $user->name,
            ],
        ]);
    }

    public function markRead(int $matchId)
    {
        $user = Auth::user();

        Message::where('match_id', $matchId)
            ->where('receiver_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return response()->json(['success' => true]);
    }

    public function unreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)->count();

        return response()->json(['count' => $count]);
    }

    // ChatController.php mein add karo

public function poll(Request $request, int $matchId)
{
    $user  = Auth::user();
    $match = UserMatch::findOrFail($matchId);

    if ($match->user_one_id !== $user->id && $match->user_two_id !== $user->id) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $after    = $request->query('after', now()->subMinutes(5)->toISOString());
    $afterDt  = \Carbon\Carbon::parse($after);

    $messages = Message::where('match_id', $matchId)
        ->where('created_at', '>', $afterDt)
        ->where('sender_id', '!=', $user->id) // only OTHER person's messages
        ->with('sender.profile')
        ->orderBy('created_at')
        ->get()
        ->map(fn($msg) => [
            'id'             => $msg->id,
            'body'           => $msg->body,
            'sender_id'      => $msg->sender_id,
            'created_at'     => $msg->created_at->format('H:i'),
            'created_at_iso' => $msg->created_at->toISOString(),
            'avatar'         => $msg->sender->getAvatarUrl(),
            'name'           => $msg->sender->name,
        ]);

    return response()->json(['messages' => $messages]);
}

    // ── Reactions ─────────────────────────────────────────────

    public function toggleReaction(Request $request, int $messageId)
    {
        $request->validate([
            'emoji' => ['required', 'string', 'max:4'],
        ]);

        $user = Auth::user();
        $message = Message::findOrFail($messageId);

        $existing = \App\Models\MessageReaction::where('message_id', $messageId)
            ->where('user_id', $user->id)
            ->where('emoji', $request->emoji)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['action' => 'removed', 'emoji' => $request->emoji]);
        }

        \App\Models\MessageReaction::create([
            'message_id' => $messageId,
            'user_id'    => $user->id,
            'emoji'      => $request->emoji,
        ]);

        return response()->json(['action' => 'added', 'emoji' => $request->emoji]);
    }

    public function getReactions(int $messageId)
    {
        $reactions = \App\Models\MessageReaction::where('message_id', $messageId)
            ->with('user')
            ->get()
            ->groupBy('emoji')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'users' => $group->pluck('user.name'),
                    'emoji' => $group->first()->emoji,
                ];
            });

        return response()->json(['reactions' => $reactions]);
    }
}