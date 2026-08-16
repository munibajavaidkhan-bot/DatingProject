<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('categoryRel')->where('user_id', auth()->id())
            ->latest()
            ->paginate(15);

        return view('author.article.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::active()->forType('article')->orderBy('name')->get();

        return view('author.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateArticle($request);

        $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        $status = $request->boolean('publish') ? 'published' : 'draft';

        Article::create([
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

        return redirect()->route('author.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(int $id)
    {
        $article    = Article::where('user_id', auth()->id())->findOrFail($id);
        $categories = Category::active()->forType('article')->orderBy('name')->get();

        return view('author.article.edit', compact('article', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $article = Article::where('user_id', auth()->id())->findOrFail($id);
        $data    = $this->validateArticle($request);

        if ($request->hasFile('cover_image')) {
            $this->deleteImage($article->cover_image);
            $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        } else {
            $data['cover_image'] = $article->cover_image;
        }

        $status = $request->boolean('publish') ? 'published' : ($request->input('status', $article->status));

        $article->update([
            'title'        => $data['title'],
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $status,
            'published_at' => $status === 'published' ? ($article->published_at ?? now()) : null,
        ]);

        return redirect()->route('author.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(int $id)
    {
        $article = Article::where('user_id', auth()->id())->findOrFail($id);
        $this->deleteImage($article->cover_image);
        $article->delete();

        return redirect()->route('author.articles.index')
            ->with('success', 'Article deleted.');
    }

    public function publish(int $id)
    {
        $article = Article::where('user_id', auth()->id())->findOrFail($id);

        $newStatus = $article->status === 'published' ? 'draft' : 'published';
        $article->update([
            'status'       => $newStatus,
            'published_at' => $newStatus === 'published' ? ($article->published_at ?? now()) : null,
        ]);

        return back()->with('success', 'Article ' . ($newStatus === 'published' ? 'published' : 'unpublished') . '.');
    }

    private function validateArticle(Request $request): array
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

        while (Article::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    private function uploadImage(Request $request, string $field): ?string
    {
        if (!$request->hasFile($field)) return null;

        $file = $request->file($field);
        $name = 'article_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
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
