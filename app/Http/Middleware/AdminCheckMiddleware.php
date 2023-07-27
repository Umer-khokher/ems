<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has the correct 'usertype'
        if (auth()->check() && auth()->user()->usertype == 1) {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have permission to access this page.');
    }
}
