<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Dosen
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
        if(auth()->user()->role != 3){
            Auth::logout();
            return redirect("/login");
        }
        return $next($request);
    }
}
