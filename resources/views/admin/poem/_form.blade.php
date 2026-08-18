<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $poem->title ?? '') }}" required minlength="3">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Author</label>
        <select name="user_id" class="form-select" required>
            @foreach($authors as $author)
            <option value="{{ $author->id }}" {{ old('user_id', $poem->user_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Status</label>
        <select name="status" class="form-select" required>
            @foreach(['draft', 'published', 'archived'] as $status)
            <option value="{{ $status }}" {{ old('status', $poem->status ?? 'draft') === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Cover Image — Upload</label>
        <input type="file" name="cover_image_file" class="form-control" accept="image/*">
        <div class="form-text">Or choose an existing asset from below. Max 4MB.</div>
        @if(!empty($poem->cover_image))
        <div class="mt-2 d-flex align-items-center gap-2">
            <img src="{{ str_starts_with($poem->cover_image, 'poems/') ? asset('storage/' . $poem->cover_image) : asset('assets/images/' . $poem->cover_image) }}"
                 alt="" style="width:56px;height:56px;object-fit:cover;border-radius:10px;">
            <span style="color:#9ca3af;font-size:12px;">{{ $poem->cover_image }}</span>
        </div>
        @endif
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Cover Image — Existing Asset</label>
        <select name="cover_image" class="form-select">
            <option value="">— No image —</option>
            @foreach($images as $file)
            <option value="{{ $file }}" {{ old('cover_image', $poem->cover_image ?? '') === $file ? 'selected' : '' }}>{{ $file }}</option>
            @endforeach
        </select>
        <div class="form-text">Upload a new image, or select an existing one from the list above.</div>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Excerpt (card text)</label>
        <textarea name="excerpt" class="form-control" rows="2" placeholder="A one-line teaser shown on the poems grid...">{{ old('excerpt', $poem->excerpt ?? '') }}</textarea>
    </div>

    <div class="col-12">
        <label class="form-label fw-semibold">Poem Body</label>
        <textarea name="body" class="form-control" rows="12" required minlength="20">{{ old('body', $poem->body ?? '') }}</textarea>
        <div class="form-text">Line breaks are preserved — write each line on its own line.</div>
    </div>

    <div class="col-12">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="featured" name="is_featured" value="1"
                {{ (old('is_featured', $poem->is_featured ?? false)) ? 'checked' : '' }}>
            <label class="form-check-label" for="featured"><b>Featured Poem</b> — shows in the large spotlight section.</label>
        </div>
    </div>
</div>