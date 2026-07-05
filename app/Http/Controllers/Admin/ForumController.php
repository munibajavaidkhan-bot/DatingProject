<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $threads = ForumThread::with('user', 'category')->latest()->paginate(20);
        return view('admin.forum.index', compact('threads'));
    }

    public function deleteThread($id)
    {
        ForumThread::findOrFail($id)->delete();
        return redirect()->route('admin.forum')->with('success', 'Thread deleted successfully.');
    }
}