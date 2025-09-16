<?php

use App\Http\Controllers\Api\V1\UserApiControlller;
use Illuminate\Support\Facades\Route;

// This route will be accessible at: /api/
Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Greenbiller.in welcomes you.',
        'data' => [
            'timestamp' => now()->toDateTimeString(),
        ],
    ]);
});

// This route will be accessible at: /api/v1/test
Route::prefix('v1')->group(function () {
    Route::get('/test', [UserApiControlller::class, 'index']);
});
