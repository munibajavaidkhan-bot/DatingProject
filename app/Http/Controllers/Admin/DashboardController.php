<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMatch;
use App\Models\Message;
use App\Models\ForumThread;
use App\Models\BlogPost;
use App\Models\Subscription;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stats Cards ───────────────────────────────────────
        $stats = [
            'total_users'    => User::where('role', 'user')->count(),
            'active_users'   => User::where('role', 'user')->where('status', 'active')->count(),
            'new_today'      => User::where('role', 'user')->whereDate('created_at', today())->count(),
            'total_matches'  => UserMatch::count(),
            'accepted_matches' => UserMatch::where('status', 'accepted')->count(),
            'total_messages' => Message::count(),
            'forum_threads'  => ForumThread::where('is_published', true)->count(),
            'blog_posts'     => BlogPost::where('status', 'published')->count(),
        ];

        // ── New Users (last 7 days) ───────────────────────────
        $newUsersChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $newUsersChart[] = [
                'date'  => $date->format('M d'),
                'count' => User::whereDate('created_at', $date->toDateString())->count(),
            ];
        }

        // ── Matches (last 7 days) ─────────────────────────────
        $matchesChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $matchesChart[] = [
                'date'  => $date->format('M d'),
                'count' => UserMatch::whereDate('created_at', $date->toDateString())->count(),
            ];
        }

        // ── Recent Users ──────────────────────────────────────
        $recentUsers = User::where('role', 'user')
            ->with('profile')
            ->latest()
            ->take(8)
            ->get();

        // ── User Status Breakdown ─────────────────────────────
        $userStatus = [
            'active'    => User::where('role', 'user')->where('status', 'active')->count(),
            'suspended' => User::where('role', 'user')->where('status', 'suspended')->count(),
            'pending'   => User::where('role', 'user')->where('status', 'pending')->count(),
        ];

        // ── Gender Breakdown ──────────────────────────────────
        $genderBreakdown = [
            'male'   => User::where('role', 'user')->where('gender', 'male')->count(),
            'female' => User::where('role', 'user')->where('gender', 'female')->count(),
            'other'  => User::where('role', 'user')->whereNotIn('gender', ['male', 'female'])->count(),
        ];

        return view('admin.dashboard', compact(
            'stats', 'newUsersChart', 'matchesChart',
            'recentUsers', 'userStatus', 'genderBreakdown'
        ));
    }
}