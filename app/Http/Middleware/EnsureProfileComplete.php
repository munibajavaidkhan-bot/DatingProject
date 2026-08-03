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

        if ($user && $user->isUser() && !$user->profile?->is_complete) {
            return redirect()->route('profile.complete')
                ->with('info', 'Please complete your profile to continue.');
        }

        return $next($request);
    }
}
