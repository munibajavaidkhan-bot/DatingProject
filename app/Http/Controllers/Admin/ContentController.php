<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentWeek;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $weeks = ContentWeek::orderBy('week_number')->get();
        $published = $weeks->where('is_published', true)->count();

        return view('admin.content.index', compact('weeks', 'published'));
    }

    public function edit(int $id)
    {
        $week = ContentWeek::findOrFail($id);

        return view('admin.content.edit', compact('week'));
    }

    public function update(Request $request, int $id)
    {
        $week = ContentWeek::findOrFail($id);

        $data = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'subtitle'    => ['nullable', 'string', 'max:300'],
            'description' => ['nullable', 'string', 'max:1000'],
            'content'     => ['required', 'string', 'min:20'],
            'theme'       => ['nullable', 'string', 'max:100'],
            'category'    => ['nullable', 'string', 'max:100'],
            'video_url'   => ['nullable', 'url', 'max:500'],
            'estimated_minutes' => ['nullable', 'integer', 'min:1', 'max:180'],
            'is_premium'  => ['nullable', 'boolean'],
            'is_published'=> ['nullable', 'boolean'],
        ]);

        $data['is_premium']   = $request->boolean('is_premium');
        $data['is_published'] = $request->boolean('is_published');

        $week->update($data);

        return redirect()->route('admin.content.index')
            ->with('success', "Week {$week->week_number} updated successfully.");
    }
}
