<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        session()->put('url.intended', $request->route()->uri);
        if(session()->has('user')){
            return $next($request);
        }else {
            return redirect()->route('login');
        }
    }
}
