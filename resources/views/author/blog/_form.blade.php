<div class="mb-3">
    <label class="form-label fw-semibold">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $post->title ?? '') }}" required minlength="10">
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Category</label>
    <select name="category_id" class="form-select" required>
        @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Excerpt</label>
    <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label fw-semibold">Article Body</label>
    <textarea name="body" class="form-control" rows="12" required minlength="50">{{ old('body', $post->body ?? '') }}</textarea>
</div>
