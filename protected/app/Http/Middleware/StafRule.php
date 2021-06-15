<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StafRule
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
        if (Auth::user()->level == 0 || Auth::user()->level == 2 || Auth::user()->level == 3 || Auth::user()->level == 4 || Auth::user()->level == 5) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
