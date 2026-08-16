<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMatch;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $query = UserMatch::where('status', 'accepted')
            ->with(['userOne.profile', 'userTwo.profile'])
            ->orderByDesc('last_message_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('userOne', fn($q) => $q->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('userTwo', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        $matches = $query->paginate(20)->withQueryString();

        $matches->getCollection()->transform(function ($match) {
            $match->last_message = Message::where('match_id', $match->id)->latest()->first();
            $match->message_count = Message::where('match_id', $match->id)->count();
            return $match;
        });

        return view('admin.chat.index', compact('matches'));
    }

    public function show(int $matchId)
    {
        $match = UserMatch::with(['userOne.profile', 'userTwo.profile'])->findOrFail($matchId);

        $messages = Message::where('match_id', $matchId)
            ->with(['sender.profile', 'receiver.profile'])
            ->orderBy('created_at')
            ->get();

        $messageCount = $messages->count();

        return view('admin.chat.show', compact('match', 'messages', 'messageCount'));
    }

    public function destroyMessage(int $messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->delete();

        return back()->with('success', 'Message deleted successfully.');
    }

    public function destroyMatch(int $matchId)
    {
        $match = UserMatch::findOrFail($matchId);
        Message::where('match_id', $matchId)->delete();
        $match->delete();

        return redirect()->route('admin.chat.index')
            ->with('success', 'Chat room and all messages deleted.');
    }
}
