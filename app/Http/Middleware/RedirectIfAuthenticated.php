<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $redirectUrl = $this->getDashboardUrl(auth()->user()->role->role); // Asumsi Anda memiliki relasi 'role' di model User
            return redirect($redirectUrl);
        }

        return $next($request);
    }

    protected function getDashboardUrl($roleName)
    {
        switch ($roleName) {
            case 'admin':
                return '/admin/dashboard';
            case 'arsiparis':
                return '/arsiparis/dashboard';
            case 'direktur':
                return '/direktur/dashboard';
            case 'user':
                return '/user/dashboard';
            default:
                return '/home';
        }
    }
}
