<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileComplete
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->isUser()) {
            if (!$user->profile?->is_complete) {
                return redirect()->route('profile.complete')
                    ->with('info', 'Please complete your profile to continue.');
            }

            if ($user->profile?->is_complete && !$user->profile?->is_approved) {
                return redirect()->route('profile.pending')
                    ->with('info', 'Your profile is under review. Please wait for admin approval.');
            }
        }

        return $next($request);
    }
}
