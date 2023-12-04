<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowsOnlyAdmin
{
    /**
     * Checks if the user is admin, if not, aborts with 403.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()?->username !== env('ADMIN_NAME') || auth()->user()?->email !== env('ADMIN_EMAIL')) {
            abort(403);
        }
        return $next($request);
    }
}
