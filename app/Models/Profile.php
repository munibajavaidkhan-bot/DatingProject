<?php

// app/Models/Profile.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'date_of_birth', 'gender',
        'city', 'country', 'latitude', 'longitude', 'bio', 'profile_picture',
        'photos', 'occupation', 'education', 'religion', 'ethnicity',
        'height_unit', 'height', 'body_type', 'relationship_goal',
        'interests', 'languages', 'smoking', 'drinking', 'has_children',
        'wants_children', 'preferred_age_min', 'preferred_age_max',
        'preferred_distance_km', 'preferred_gender', 'preferred_religions',
        'preferred_ethnicities', 'is_complete', 'is_approved', 'rejection_reason',
        'is_verified', 'show_online',
        'last_active', 'profile_views', 'personality_type', 'quiz_score',
    ];

    protected $casts = [
        'date_of_birth'        => 'date',
        'photos'               => 'array',
        'interests'            => 'array',
        'languages'            => 'array',
        'preferred_religions'  => 'array',
        'preferred_ethnicities'=> 'array',
        'is_complete'          => 'boolean',
        'is_approved'          => 'boolean',
        'is_verified'          => 'boolean',
        'show_online'          => 'boolean',
        'last_active'          => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ─── Accessors ───────────────────────────────────────────
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth
            ? Carbon::parse($this->date_of_birth)->age
            : null;
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    public function getAvatarUrlAttribute(): string
    {
        if ($this->profile_picture) {
            return asset('storage/' . $this->profile_picture);
        }
        // Use UI Avatars as fallback - free service
        $name = urlencode($this->full_name ?: 'User');
        return "https://ui-avatars.com/api/?name={$name}&background=ec4899&color=fff&size=200&bold=true";
    }

    public function getLocationAttribute(): string
    {
        return collect([$this->city, $this->country])
            ->filter()
            ->implode(', ');
    }

    public function getInterestsListAttribute(): array
    {
        return $this->interests ?? [];
    }

    // ─── Scopes ───────────────────────────────────────────────
    public function scopeComplete($query)
    {
        return $query->where('is_complete', true);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_complete', true)->where('is_approved', false);
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }
}