<div style="display:grid;gap:16px;">
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required
               style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
    </div>
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Excerpt</label>
        <textarea name="excerpt" rows="2" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
    </div>
    <div>
        <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Body</label>
        <textarea name="body" rows="10" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">{{ old('body', $post->body ?? '') }}</textarea>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Category</label>
            <select name="category_id" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Author</label>
            <select name="user_id" required style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                @foreach($authors as $author)
                <option value="{{ $author->id }}" {{ old('user_id', $post->user_id ?? auth()->id()) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-6">
            <label style="display:block;color:#9ca3af;font-size:12px;font-weight:600;margin-bottom:6px;">Status</label>
            <select name="status" style="width:100%;padding:10px 14px;background:#0f0f14;border:1px solid rgba(255,255,255,0.1);border-radius:10px;color:white;">
                @foreach(['draft','published','archived'] as $s)
                <option value="{{ $s }}" {{ old('status', $post->status ?? 'draft') === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6" style="display:flex;align-items:end;padding-bottom:8px;">
            <label style="color:#d1d5db;font-size:14px;cursor:pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $post->is_featured ?? false) ? 'checked' : '' }}> Featured post
            </label>
        </div>
    </div>
</div>
