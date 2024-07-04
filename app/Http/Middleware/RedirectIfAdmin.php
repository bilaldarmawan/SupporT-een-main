<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated and an admin
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // If not an admin, redirect to a specific route (e.g., home)
        return redirect('/home')->with('error', 'You do not have admin access');
    }
}
