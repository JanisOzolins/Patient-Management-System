<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MedicalStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && Auth::user()->user_type === "doctor") {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->user_type === "nurse") {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->user_type === "staff") {
            return $next($request);
        }
        else {
            return redirect('/');
        }
    }
}
