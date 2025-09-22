<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleCheck
{
    /**
     * Handle an incoming request.
     * Roles can be passed as comma-separated string, e.g. "1,2"
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = $request->user();

        if (! $user) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }

        $allowedRoles = explode(',', $roles);

        if (! in_array($user->role_id, $allowedRoles)) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], 403);
        }

        return $next($request);
    }
}
