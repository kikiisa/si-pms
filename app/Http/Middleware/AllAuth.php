<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('operators')->check() || Auth::guard('dpls')->check() || Auth::guard('pamongs')->check() || Auth::check())
        {
            return $next($request);
        }
        return redirect()->route('auth')->with('error','Maaf Anda Harus Login Terlebih Dahulu');
        
    }
}
