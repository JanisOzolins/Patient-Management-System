<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class MedicalPatient
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
        if(Auth::check() && Auth::user()->user_type === "nurse") {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->user_type === "doctor") {
            return $next($request);
        }
        elseif(Auth::check() && Auth::user()->id === $request->uid) {
            return $next($request);
        }
        else {
            return back();
        }
    }
}
