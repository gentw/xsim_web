<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserActive
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
        if (Auth::check()) {
            if ($request->user()->active == 0) {
                flash('Your Account is inactive.')->error();
                Auth::logout();
                return redirect()->route('login');
            }
        }
        
        return $next($request);
    }
}
