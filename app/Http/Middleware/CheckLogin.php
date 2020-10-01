<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
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
        
        if ( Auth::user() == null ){
            return redirect()->route('login');
        } else {
            // dd(Auth::user());
            return $next($request);
        }
        return $next($request);
    }
}
