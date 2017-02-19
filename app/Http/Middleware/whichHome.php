<?php

namespace App\Http\Middleware;

use Closure;

class whichHome
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
        if ($request->user()->isStaff($request->user()) == "staff") 

        {

           return redirect('/staff');

        }
        elseif ($request->user()->isStaff($request->user()) == "doctor") 

        {

           return redirect('/doctor');

        }
        else 

        {

           return redirect('/patient');

        }

        
    }
}
