<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Mhs
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
        // dd(auth()->user()->role);
        if(auth()->user()->role != 4){
            Auth::logout();
            return redirect("/login");
        }

        return $next($request);
    }
}
