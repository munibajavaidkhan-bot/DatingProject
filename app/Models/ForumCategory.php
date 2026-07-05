<?php

namespace App\Models;

// app/Models/ForumCategory.php

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'icon', 'color', 'sort_order', 'is_active', 'threads_count',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id');
    }
}