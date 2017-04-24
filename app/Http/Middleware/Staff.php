<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Staff
{
    /**
     * Includes doctors, nurses and staff
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->user_type === "staff") {
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
