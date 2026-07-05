<?php

// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id', 'receiver_id', 'match_id',
        'body', 'type', 'attachment',
        'is_read', 'read_at',
        'is_deleted_by_sender', 'is_deleted_by_receiver',
    ];

    protected $casts = [
        'is_read'                  => 'boolean',
        'is_deleted_by_sender'     => 'boolean',
        'is_deleted_by_receiver'   => 'boolean',
        'read_at'                  => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function match()
    {
        return $this->belongsTo(UserMatch::class, 'match_id');
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    public function scopeVisibleTo($query, int $userId)
    {
        return $query->where(function ($q) use ($userId) {
            $q->where('sender_id', $userId)
              ->where('is_deleted_by_sender', false);
        })->orWhere(function ($q) use ($userId) {
            $q->where('receiver_id', $userId)
              ->where('is_deleted_by_receiver', false);
        });
    }
}