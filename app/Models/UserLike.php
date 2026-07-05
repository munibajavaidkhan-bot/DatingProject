<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'type', 'is_mutual', 'mutual_at'
    ];

    protected $casts = [
        'is_mutual' => 'boolean',
        'mutual_at' => 'datetime',
    ];

    // ── Relationships ─────────────────────────────────────────
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // ── Scopes ────────────────────────────────────────────────
    public function scopeMutual($query)
    {
        return $query->where('is_mutual', true);
    }

    public function scopeSuperLikes($query)
    {
        return $query->where('type', 'super_like');
    }
}