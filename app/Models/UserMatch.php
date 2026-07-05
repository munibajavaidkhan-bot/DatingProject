<?php

// app/Models/UserMatch.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{
    use HasFactory;

    protected $table = 'user_matches';

    protected $fillable = [
        'user_one_id', 'user_two_id', 'compatibility_score',
        'quiz_score', 'interest_score', 'location_score', 'preference_score',
        'status', 'action_by', 'user_one_liked', 'user_two_liked',
        'matched_at', 'last_message_at',
    ];

    protected $casts = [
        'user_one_liked' => 'boolean',
        'user_two_liked' => 'boolean',
        'matched_at'     => 'datetime',
        'last_message_at'=> 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────
    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'match_id');
    }

    // ─── Helpers ──────────────────────────────────────────────
    /**
     * Get the other user in the match (not the current user)
     */
    public function getOtherUser(int $currentUserId): User
    {
        return $this->user_one_id === $currentUserId
            ? $this->userTwo
            : $this->userOne;
    }

    public function isAccepted(): bool
    {
        return $this->status === 'accepted';
    }

    public function isMutualMatch(): bool
    {
        return $this->user_one_liked && $this->user_two_liked;
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_one_id', $userId)
                     ->orWhere('user_two_id', $userId);
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeSuggested($query)
    {
        return $query->where('status', 'suggested');
    }
}