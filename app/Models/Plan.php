<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_monthly',
        'price_yearly',
        'features',
        'matches_per_day',
        'messages_per_day',
        'can_see_who_liked',
        'can_boost_profile',
        'has_read_receipts',
        'has_advanced_filter',
        'has_video_chat',
        'is_active',
        'is_featured',
        'badge_color',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
