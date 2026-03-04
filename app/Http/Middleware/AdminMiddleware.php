<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('staff')->user();

        if (!$user || !$user->isAdmin()) {
            abort(403, 'Admin access denied');
        }

        return $next($request);
    }
}
