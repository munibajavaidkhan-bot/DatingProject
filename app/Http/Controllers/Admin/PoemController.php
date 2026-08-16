<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::with('author')->latest()->paginate(20);

        return view('admin.poem.index', compact('poems'));
    }

    public function create()
    {
        $authors = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $images  = $this->assetImages();

        return view('admin.poem.create', compact('authors', 'images'));
    }

    public function store(Request $request)
    {
        $data = $this->validatePoem($request);

        Poem::create([
            'user_id'      => $data['user_id'],
            'title'        => $data['title'],
            'slug'         => $this->uniqueSlug($data['title']),
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'cover_image'  => $this->handleCoverImage($request, null),
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.poems.index')->with('success', 'Poem created.');
    }

    public function edit(int $id)
    {
        $poem    = Poem::findOrFail($id);
        $authors = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $images  = $this->assetImages();

        return view('admin.poem.edit', compact('poem', 'authors', 'images'));
    }

    public function update(Request $request, int $id)
    {
        $poem = Poem::findOrFail($id);
        $data = $this->validatePoem($request);

        $poem->update([
            'user_id'      => $data['user_id'],
            'title'        => $data['title'],
            'excerpt'      => $data['excerpt'],
            'body'         => $data['body'],
            'cover_image'  => $this->handleCoverImage($request, $poem),
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $data['status'] === 'published' ? ($poem->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.poems.index')->with('success', 'Poem updated.');
    }

    public function destroy(int $id)
    {
        $poem = Poem::findOrFail($id);

        if (str_starts_with($poem->cover_image ?? '', 'poems/')) {
            Storage::disk('public')->delete($poem->cover_image);
        }

        $poem->delete();

        return redirect()->route('admin.poems.index')->with('success', 'Poem deleted.');
    }

    private function validatePoem(Request $request): array
    {
        return $request->validate([
            'title'            => ['required', 'string', 'min:3', 'max:200'],
            'excerpt'          => ['nullable', 'string', 'max:500'],
            'body'             => ['required', 'string', 'min:20'],
            'cover_image'      => ['nullable', 'string', 'max:255'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:4096'],
            'user_id'          => ['required', 'exists:users,id'],
            'status'           => ['required', 'in:draft,published,archived'],
        ]);
    }

    private function handleCoverImage(Request $request, ?Poem $poem): ?string
    {
        if ($request->hasFile('cover_image_file')) {
            $path = $request->file('cover_image_file')->store('poems', 'public');

            if ($poem && str_starts_with($poem->cover_image ?? '', 'poems/')) {
                Storage::disk('public')->delete($poem->cover_image);
            }

            return $path;
        }

        return $request->input('cover_image');
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