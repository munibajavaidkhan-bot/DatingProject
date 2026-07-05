<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || (!auth()->user()->isAuthor() && !auth()->user()->isAdmin())) {
            abort(403, 'Access denied. Authors only.');
        }
        return $next($request);
    }
}