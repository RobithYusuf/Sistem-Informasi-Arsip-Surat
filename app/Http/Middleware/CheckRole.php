<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // CheckRole middleware dengan id role bukan nama role
    // public function handle($request, Closure $next, ...$roles)
    // {
    //     if (!auth()->user() || !in_array(auth()->user()->role_id, $roles)) {
    //         return redirect('home');
    //     }
    //     return $next($request);
    // }

    public function handle($request, Closure $next, ...$roles)
    {
        if (!auth()->user() || !in_array(auth()->user()->role->role, $roles)) {
            return redirect('home');
        }
        return $next($request);
    }
}
