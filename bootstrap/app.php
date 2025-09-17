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
    ]);

    $middleware->group('api', [
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    ]);
})
    ->withExceptions(function (Exceptions $exceptions): void {
         $exceptions->render(function (Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'error'   => $e->getMessage(),
                ], 500);
            }
        });
    })->create();
