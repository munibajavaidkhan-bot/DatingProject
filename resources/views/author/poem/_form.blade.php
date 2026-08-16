<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $poem->title ?? '') }}" required minlength="3">
    </div>

    <div class="col-md-6">
        <label class="form-label fw-semibold">Cover Image</label>
        <select name="cover_image" class="form-select">
            <option value="">— No image —</option>
            @foreach($images as $file)
            <option value="{{ $file }}" {{ old('cover_image', $poem->cover_image ?? '') === $file ? 'selected' : '' }}>{{ $file }}</option>
            @endforeach
        </select>
        <div class="form-text">Choose an image from the existing site assets.</div>
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
            <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1"
                {{ old('publish') ? 'checked' : '' }}>
            <label class="form-check-label" for="publish"><b>Publish now</b> — uncheck to save as draft.</label>
        </div>
    </div>
</div>