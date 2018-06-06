<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedKasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'kasir')
    {

        if (Auth::guard($guard)->check()) {
            if(Auth::guard($guard)->user()->role == 'kasir'){
                return redirect('/kasir/dashboard');
            }
        }
        return $next($request);
    }
}
