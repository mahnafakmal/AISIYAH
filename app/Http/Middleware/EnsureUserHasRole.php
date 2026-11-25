<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $allowedRoles = [];

        foreach ($roles as $roleGroup) {
            array_push($allowedRoles, ...explode('|', $roleGroup));
        }

        if (! $request->user() || ! in_array($request->user()->role, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}
