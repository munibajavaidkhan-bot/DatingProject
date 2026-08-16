<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with(['author', 'categoryRel'])->latest()->paginate(20);

        return view('admin.story.index', compact('stories'));
    }

    public function create()
    {
        $authors    = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $categories = Category::active()->forType('story')->orderBy('name')->get();

        return view('admin.story.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateStory($request);

        $data['cover_image'] = $this->uploadImage($request, 'cover_image');

        Story::create([
            'user_id'      => $data['user_id'],
            'title'        => $data['title'],
            'slug'         => $this->uniqueSlug($data['title']),
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'Story created.');
    }

    public function edit(int $id)
    {
        $story      = Story::findOrFail($id);
        $authors    = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $categories = Category::active()->forType('story')->orderBy('name')->get();

        return view('admin.story.edit', compact('story', 'authors', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $story = Story::findOrFail($id);
        $data  = $this->validateStory($request);

        if ($request->hasFile('cover_image')) {
            $this->deleteImage($story->cover_image);
            $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        } else {
            $data['cover_image'] = $story->cover_image;
        }

        $story->update([
            'user_id'      => $data['user_id'],
            'title'        => $data['title'],
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $data['status'] === 'published' ? ($story->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.stories.index')->with('success', 'Story updated.');
    }

    public function destroy(int $id)
    {
        $story = Story::findOrFail($id);
        $this->deleteImage($story->cover_image);
        $story->delete();

        return redirect()->route('admin.stories.index')->with('success', 'Story deleted.');
    }

    private function validateStory(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'min:10', 'max:200'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string', 'min:50'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'user_id'     => ['required', 'exists:users,id'],
            'status'      => ['required', 'in:draft,published,archived'],
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i    = 1;

        while (Story::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function uploadImage(Request $request, string $field): ?string
    {
        if (!$request->hasFile($field)) return null;

        $file = $request->file($field);
        $name = 'story_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $name);

        return $name;
    }

    private function deleteImage(?string $filename): void
    {
        if ($filename && file_exists(public_path('images/' . $filename))) {
            unlink(public_path('images/' . $filename));
        }
    }
}
