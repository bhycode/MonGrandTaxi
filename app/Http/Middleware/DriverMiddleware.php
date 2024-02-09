<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DriverMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 2) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'You do not have permission to access the driver dashboard.');
    }
}

