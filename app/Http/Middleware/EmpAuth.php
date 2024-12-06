<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EmpAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next , $guard = 'front-user'): Response
    {
        if (!Auth::guard($guard)->check()) { 
            /**
             * if front user is not logged in then set intended redirection & add cart
             */
            return redirect('/Emlogin');
        } 
        return $next($request);
    }
}
