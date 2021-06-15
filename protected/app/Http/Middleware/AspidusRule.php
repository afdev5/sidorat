<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AspidusRule
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
        if (Auth::user()->level == 1 || Auth::user()->level == 0) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
