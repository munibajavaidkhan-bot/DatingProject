<div style="display:grid;gap:16px;">
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Title</label>
        <input type="text" name="title" value="{{ old('title', $story->title ?? '') }}" required
               style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Category</label>
            <select name="category_id" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                <option value="">— Select Category —</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $story->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Author</label>
            <select name="user_id" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ old('user_id', $story->user_id ?? auth()->id()) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Excerpt</label>
        <textarea name="excerpt" rows="2" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('excerpt', $story->excerpt ?? '') }}</textarea>
    </div>
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Body</label>
        <textarea name="body" rows="12" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('body', $story->body ?? '') }}</textarea>
    </div>
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Cover Image</label>
        <input type="file" name="cover_image" accept="image/*"
               style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
        @if(!empty($story->cover_image))
        <div style="margin-top:8px;">
            <img src="{{ asset('images/' . $story->cover_image) }}" alt="Current cover" style="height:60px;border-radius:8px;object-fit:cover;">
        </div>
        @endif
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Status</label>
            <select name="status" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                @foreach(['draft','published','archived'] as $s)
                <option value="{{ $s }}" {{ old('status', $story->status ?? 'draft') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6" style="display:flex;align-items:end;padding-bottom:8px;">
            <label style="color:#d1d5db;font-size:14px;cursor:pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $story->is_featured ?? false) ? 'checked' : '' }}> Featured story
            </label>
        </div>
    </div>
</div>
