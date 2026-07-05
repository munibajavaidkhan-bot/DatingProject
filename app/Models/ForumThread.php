<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'body',
        'tags', 'is_pinned', 'is_locked', 'is_published',
        'views', 'replies_count', 'likes_count', 'last_reply_at',
    ];

    protected $casts = [
        'tags'          => 'array',
        'is_pinned'     => 'boolean',
        'is_locked'     => 'boolean',
        'is_published'  => 'boolean',
        'last_reply_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function posts()
    {
        return $this->hasMany(ForumPost::class, 'thread_id');
    }

    public function getExcerptAttribute(): string
    {
        return \Str::limit(strip_tags($this->body), 150);
    }
}