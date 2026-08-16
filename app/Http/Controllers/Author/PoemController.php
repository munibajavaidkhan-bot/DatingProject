<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Poem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::where('user_id', auth()->id())
            ->with('author')
            ->latest()
            ->paginate(15);

        return view('author.poem.index', compact('poems'));
    }

    public function create()
    {
        $images = $this->assetImages();

        return view('author.poem.create', compact('images'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePoem($request);

        $status = $request->boolean('publish') ? 'published' : 'draft';

        Poem::create([
            'user_id'      => auth()->id(),
            'title'        => $data['title'],
            'slug'         => $this->uniqueSlug($data['title']),
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'status'       => $status,
            'is_featured'  => false,
            'published_at' => $status === 'published' ? now() : null,
        ]);

        return redirect()->route('author.poems.index')
            ->with('success', 'Poem created successfully.');
    }

    public function edit(int $id)
    {
        $poem   = Poem::where('user_id', auth()->id())->findOrFail($id);
        $images = $this->assetImages();

        return view('author.poem.edit', compact('poem', 'images'));
    }

    public function update(Request $request, int $id)
    {
        $poem = Poem::where('user_id', auth()->id())->findOrFail($id);
        $data = $this->validatePoem($request);

        $status = $request->boolean('publish') ? 'published' : $request->input('status', $poem->status);

        $poem->update([
            'title'        => $data['title'],
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'status'       => $status,
            'published_at' => $status === 'published' ? ($poem->published_at ?? now()) : null,
        ]);

        return redirect()->route('author.poems.index')
            ->with('success', 'Poem updated successfully.');
    }

    public function destroy(int $id)
    {
        Poem::where('user_id', auth()->id())->findOrFail($id)->delete();

        return redirect()->route('author.poems.index')
            ->with('success', 'Poem deleted.');
    }

    public function publish(int $id)
    {
        $poem = Poem::where('user_id', auth()->id())->findOrFail($id);

        $newStatus = $poem->status === 'published' ? 'draft' : 'published';
        $poem->update([
            'status'       => $newStatus,
            'published_at' => $newStatus === 'published' ? ($poem->published_at ?? now()) : null,
        ]);

        return back()->with('success', 'Poem ' . ($newStatus === 'published' ? 'published' : 'unpublished') . '.');
    }

    private function validatePoem(Request $request): array
    {
        return $request->validate([
            'title'       => ['required', 'string', 'min:3', 'max:200'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'body'        => ['required', 'string', 'min:20'],
            'cover_image' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $base = $slug;
        $i    = 1;

        while (Poem::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function assetImages(): array
    {
        $dir = public_path('assets/images');

        if (! is_dir($dir)) {
            return [];
        }

        $files = File::files($dir);

        return collect($files)
            ->map(fn ($file) => $file->getFilename())
            ->filter(fn ($name) => in_array(strtolower(pathinfo($name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'webp']))
            ->values()
            ->all();
    }
}