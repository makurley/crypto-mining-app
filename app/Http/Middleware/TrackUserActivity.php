<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TrackUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(2); // keep user "online" for 2 minutes
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
        }

        return $next($request);
    }
}
