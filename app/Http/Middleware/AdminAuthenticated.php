<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AdminAuthenticated
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
        // echo Auth::user();
        // exit;
        //this is check for customer not login admin paneal
        if(Auth::user()->role->name == 'customer'){
            return redirect('/home');
        }
        return $next($request);
    }
}
