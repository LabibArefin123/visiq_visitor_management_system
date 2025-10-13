<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, $permission)
    {
        // Assuming you have a permission checking mechanism
        if (!Auth::user()->hasPermissionTo($permission)) {
            return redirect('no-access');  // Redirect or show an error page
        }

        return $next($request);
    }
}
