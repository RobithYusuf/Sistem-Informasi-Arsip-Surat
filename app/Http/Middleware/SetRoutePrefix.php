<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetRoutePrefix
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $currentRoutePrefix = request()->route()->getPrefix();
      view()->share('currentRoutePrefix', ltrim(request()->route()->getPrefix(), '/'));


        return $next($request);
    }
}
