<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'type', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForType($query, string $type)
    {
        return $query->where('type', $type)->orWhere('type', 'both');
    }
}
