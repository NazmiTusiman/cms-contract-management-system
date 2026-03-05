<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */


    public function handle(Request $request, \Closure $next, ...$roles)
    {
        $roleId = (int) $request->user()->role_id; //Auth::

        $map = [
            'superadmin' => 1,
            'admin' => 2,
            'user' => 3,
        ];

        $allowed = array_map(fn($r) => $map[$r] ?? null, $roles);

        if (! in_array($roleId, $allowed, true)){
            abort(403);
        }
        return $next($request);
    }
}
