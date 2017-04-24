<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Medical
{
    /**
     * ROUTE FOR SENSITIVE INFORMATION (Only medical staff and the user himself)
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->user_type === "doctor") {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->user_type === "nurse") {
            return $next($request);
        }
    }
}
