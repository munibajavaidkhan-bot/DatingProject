<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContentProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'content_week_id', 'is_unlocked', 'is_completed',
        'is_bookmarked', 'progress_percent', 'unlocked_at', 'completed_at',
        'completed_exercises', 'personal_notes', 'reflection_rating',
    ];

    protected $casts = [
        'is_unlocked'         => 'boolean',
        'is_completed'        => 'boolean',
        'is_bookmarked'       => 'boolean',
        'unlocked_at'         => 'datetime',
        'completed_at'        => 'datetime',
        'completed_exercises' => 'array',
    ];

    // ─── Relationships ────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contentWeek()
    {
        return $this->belongsTo(ContentWeek::class, 'content_week_id');
    }
}