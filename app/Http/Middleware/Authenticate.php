<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        return null; // prevent redirects for API
    }

    protected function unauthenticated($request, array $guards)
    {
         // Directly return JSON without abort
        return response()->json([
            'success' => false,
            'message' => 'Unauthenticated. Token missing or invalid.',
        ], 401)->send();

        // Stop further processing
        exit;
    }
}
