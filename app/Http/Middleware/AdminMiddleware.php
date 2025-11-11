<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
{
  public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return $next($request);
            }

            return redirect()->route('index')->with('error', 'Unauthorized access.');
        }

        session(['link' => url()->current()]);
        return redirect()->route('login'); // or 'admin.login' if you have a custom route
    }

}