<?php


use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use Illuminate\Support\Facades\Route;

Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::get('/oauth/tokens', [AuthorizedAccessTokenController::class, 'forUser']);
Route::delete('/oauth/tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);
Route::post('/oauth/token/refresh', [TransientTokenController::class, 'refresh']);

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
   Route::prefix('registration')->group(function () {
        require base_path('routes/user/api_registration.php');
    });
});
