<?php

// app/Http/Controllers/Member/NotificationController.php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->with('fromUser.profile')
            ->latest()
            ->paginate(20);

        // Mark all as read
        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('user.notifications', compact('notifications'));
    }

    public function markRead(int $id)
    {
        $notification = Notification::where('user_id', Auth::id())
            ->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    public function readAll()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function getUnread()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->with('fromUser.profile')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn($n) => [
                'id'      => $n->id,
                'title'   => $n->title,
                'message' => $n->message,
                'icon'    => $n->icon,
                'color'   => $n->color,
                'url'     => $n->action_url,
                'time'    => $n->created_at->diffForHumans(),
                'avatar'  => $n->fromUser?->getAvatarUrl(),
            ]);

        return response()->json([
            'count'         => Notification::where('user_id', Auth::id())->where('is_read', false)->count(),
            'notifications' => $notifications,
        ]);
    }
}