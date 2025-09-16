<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Override default redirect to return JSON for APIs.
     */
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null; // Prevents redirect
        }

        return route('login'); // Only relevant if you keep a web login
    }

    /**
     * Override unauthenticated response for APIs.
     */
    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(response()->json([
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401));
        }

        parent::unauthenticated($request, $guards);
    }
}
