<?php

// routes/channels.php

use Illuminate\Support\Facades\Broadcast;
use App\Models\UserMatch;

Broadcast::channel('match.{matchId}', function ($user, $matchId) {
    $match = UserMatch::find($matchId);
    return $match && (
        $match->user_one_id === $user->id ||
        $match->user_two_id === $user->id
    );
});