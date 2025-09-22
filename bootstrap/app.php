<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\Authenticate::class,
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'role' => \App\Http\Middleware\RoleCheck::class,
        ]);

        $middleware->group('api', [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'throttle:120,1', // 120 requests per 1 minute
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function ($e, Request $request) {
            if ($request->is('api/*')) {

                if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthenticated. Token missing or invalid.',
                    ], 401);
                }

                if ($e instanceof \Laravel\Passport\Exceptions\MissingScopeException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Unauthorized. Scope missing.',
                    ], 403);
                }

                return response()->json([
                    'success' => false,
                    'error' => $e->getMessage() ?: 'Server error',
                ], method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500);
            }
        });
    })

    ->create();
