<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class PassengerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 3) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
