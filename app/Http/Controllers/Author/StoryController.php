<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('categoryRel')->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('author.story.index', compact('stories'));
    }

    public function create()
    {
        $categories = Category::active()->forType('story')->orderBy('name')->get();

        return view('author.story.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateStory($request);

        $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        $status = $request->boolean('publish') ? 'published' : 'draft';

        Story::create([
            'user_id'      => auth()->id(),
            'title'        => $data['title'],
            'slug'         => $this->uniqueSlug($data['title']),
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $status,
            'is_featured'  => false,
            'published_at' => $status === 'published' ? now() : null,
        ]);

        return redirect()->route('author.stories.index')
            ->with('success', 'Story created successfully.');
    }

    public function edit(int $id)
    {
        $story      = Story::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::active()->forType('story')->orderBy('name')->get();

        return view('author.story.edit', compact('story', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $story = Story::where('user_id', auth()->id())->findOrFail($id);
        $data  = $this->validateStory($request);

        if ($request->hasFile('cover_image')) {
            $this->deleteImage($story->cover_image);
            $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        } else {
            $data['cover_image'] = $story->cover_image;
        }

        $status = $request->boolean('publish') ? 'published' : ($request->input('status', $story->status));

        $story->update([
            'title'        => $data['title'],
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $status,
            'published_at' => $status === 'published' ? ($story->published_at ?? now()) : null,
        ]);

        return redirect()->route('author.stories.index')
            ->with('success', 'Story updated successfully.');
    }

    public function destroy(int $id)
    {
        $story = Story::where('user_id', auth()->id())->findOrFail($id);
        $this->deleteImage($story->cover_image);
        $story->delete();

        return redirect()->route('author.stories.index')
            ->with('success', 'Story deleted.');
    }

    public function publish(int $id)
    {
        $story = Story::where('user_id', auth()->id())->findOrFail($id);

        $newStatus = $story->status === 'published' ? 'draft' : 'published';
        $story->update([
            'status'       => $newStatus,
            'published_at' => $newStatus === 'published' ? ($story->published_at ?? now()) : null,
        ]);

        return back()->with('success', 'Story ' . ($newStatus === 'published' ? 'published' : 'unpublished') . '.');
    }

    private function validateStory(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'min:10', 'max:200'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string', 'min:50'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
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
