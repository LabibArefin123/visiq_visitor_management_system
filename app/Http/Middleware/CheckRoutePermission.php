<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckRoutePermission
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized.');
        }

        $role = DB::table('roles_permissions')->where('user_type', $user->user_type)->first();

        $allowedRoutes = json_decode($role->routes ?? '[]', true);
        $currentRoute = $request->route()?->getName();

        if (!in_array($currentRoute, $allowedRoutes)) {
            abort(403, 'You do not have permission to access this route.');
        }

        return $next($request);
    }
}
