<div class="mb-3">
    <label class="form-label fw-semibold">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $article->title ?? '') }}" required minlength="10">
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Category</label>
    <select name="category_id" class="form-select">
        <option value="">— Select Category —</option>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $article->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Excerpt</label>
    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Article Body</label>
    <textarea name="body" class="form-control" rows="12" required minlength="50">{{ old('body', $article->body ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Cover Image</label>
    <input type="file" name="cover_image" class="form-control" accept="image/*">
    @if(!empty($article->cover_image))
    <div class="mt-2">
        <img src="{{ asset('images/' . $article->cover_image) }}" alt="Current cover" style="height:60px;border-radius:8px;object-fit:cover;">
    </div>
    @endif
</div>
