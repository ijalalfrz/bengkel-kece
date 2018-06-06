<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class KasirMiddleware
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
        if(Auth::guard('kasir')->check() && Auth::guard('kasir')->user()->role == 'kasir')
            return $next($request);
        return redirect('kasir/login');
    }
}
