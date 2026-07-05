<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentWeek;

class ContentController extends Controller
{
    public function index()
    {
        $weeks = ContentWeek::orderBy('week_number')->get();
        $published = $weeks->where('is_published', true)->count();

        return view('admin.content.index', compact('weeks', 'published'));
    }

    public function edit($id)
    {
        $week = ContentWeek::findOrFail($id);

        return view('admin.content.edit', compact('week'));
    }
}
