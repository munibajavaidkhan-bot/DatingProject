<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'excerpt', 'body',
        'cover_image', 'status', 'is_featured', 'views', 'published_at',
    ];

    protected $casts = [
        'is_featured'  => 'boolean',
        'published_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}