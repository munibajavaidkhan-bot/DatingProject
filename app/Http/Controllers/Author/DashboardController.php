<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $stats = [
            'published'  => BlogPost::where('user_id', $userId)->where('status', 'published')->count(),
            'drafts'     => BlogPost::where('user_id', $userId)->where('status', 'draft')->count(),
            'total_views'=> BlogPost::where('user_id', $userId)->sum('views'),
        ];

        $recentPosts = BlogPost::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('author.dashboard', compact('stats', 'recentPosts'));
    }
}
