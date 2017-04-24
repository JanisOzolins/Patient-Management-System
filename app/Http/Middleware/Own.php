<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Own
{
    /**
     *  ROUTE FOR NON-SENSITIVE INFORMATION
     */
    public function handle($request, Closure $next)
    {
        if($request->uid === Auth::user()->id) {
            return $next($request);
        }
    }
}
