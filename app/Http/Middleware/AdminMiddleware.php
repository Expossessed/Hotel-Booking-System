<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Protect admin routes: ensure the request is authenticated and the user is an admin.
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            // Unauthenticated users or non-admins should not be able to access admin pages.
            abort(403, 'This action is unauthorized.');
        }

        return $next($request);
    }
}
