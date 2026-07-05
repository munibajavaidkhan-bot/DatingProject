<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentWeek extends Model
{
    use HasFactory;

    protected $fillable = [
        'week_number', 'title', 'subtitle', 'description', 'content',
        'theme', 'category', 'video_url', 'cover_image',
        'exercises', 'affirmations', 'reflection_questions',
        'is_premium', 'is_published', 'estimated_minutes',
    ];

    protected $casts = [
        'exercises'            => 'array',
        'affirmations'         => 'array',
        'reflection_questions' => 'array',
        'is_premium'           => 'boolean',
        'is_published'         => 'boolean',
    ];

    // Category labels for display
    public static array $categories = [
        'self_discovery'      => 'Self Discovery',
        'communication'       => 'Communication',
        'emotional_intelligence' => 'Emotional Intelligence',
        'intimacy'            => 'Intimacy',
        'conflict_resolution' => 'Conflict Resolution',
        'shared_values'       => 'Shared Values',
        'future_planning'     => 'Future Planning',
        'appreciation'        => 'Appreciation',
        'trust_building'      => 'Trust Building',
        'growth'              => 'Growth',
    ];

    // ─── Relationships ────────────────────────────────────────
    public function userProgress()
    {
        return $this->hasMany(UserContentProgress::class, 'content_week_id');
    }

    public function progressForUser(int $userId)
    {
        return $this->userProgress()->where('user_id', $userId)->first();
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('week_number');
    }

    public function scopeFree($query)
    {
        return $query->where('is_premium', false);
    }
}