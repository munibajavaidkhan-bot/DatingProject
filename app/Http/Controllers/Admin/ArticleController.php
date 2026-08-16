<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'categoryRel'])->latest()->paginate(20);

        return view('admin.article.index', compact('articles'));
    }

    public function create()
    {
        $authors   = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $categories = Category::active()->forType('article')->orderBy('name')->get();

        return view('admin.article.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateArticle($request);

        $data['cover_image'] = $this->uploadImage($request, 'cover_image');

        Article::create([
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

        return redirect()->route('admin.articles.index')->with('success', 'Article created.');
    }

    public function edit(int $id)
    {
        $article    = Article::findOrFail($id);
        $authors    = User::whereIn('role', ['author', 'admin'])->orderBy('name')->get();
        $categories = Category::active()->forType('article')->orderBy('name')->get();

        return view('admin.article.edit', compact('article', 'authors', 'categories'));
    }

    public function update(Request $request, int $id)
    {
        $article = Article::findOrFail($id);
        $data    = $this->validateArticle($request);

        if ($request->hasFile('cover_image')) {
            $this->deleteImage($article->cover_image);
            $data['cover_image'] = $this->uploadImage($request, 'cover_image');
        } else {
            $data['cover_image'] = $article->cover_image;
        }

        $article->update([
            'user_id'      => $data['user_id'],
            'title'        => $data['title'],
            'category_id'  => $data['category_id'] ?? null,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_image'  => $data['cover_image'],
            'read_minutes' => max(1, (int) ceil(str_word_count(strip_tags($data['body'])) / 200)),
            'status'       => $data['status'],
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $data['status'] === 'published' ? ($article->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Article updated.');
    }

    public function destroy(int $id)
    {
        $article = Article::findOrFail($id);
        $this->deleteImage($article->cover_image);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Article deleted.');
    }

    private function validateArticle(Request $request): array
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
