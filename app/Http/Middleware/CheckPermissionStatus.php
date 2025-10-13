<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class CheckPermissionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $routeName
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $routeName)
    {
        // Find the permission by route name
        $permission = Permission::where('name', $routeName)->first();

        // If the permission exists and is not active, deny access
        if ($permission && !$permission->is_active) {
            return response()->view('errors.restricted', [], 403); // Custom restricted page
        }

        return $next($request);
    }
}
