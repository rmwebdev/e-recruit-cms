<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class RedirectIfLoginBackend
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
        // return $next($request);
        if(!Session::get('user'))
        {
            return redirect('/login');
        }
        else
        {
            $moduleUrl = '/rec-process';
        }
        return $next($request);
    }
}