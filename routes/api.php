<?php


use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController;
use Laravel\Passport\Http\Controllers\TransientTokenController;
use Illuminate\Support\Facades\Route;

//public 
Route::post('/oauth/token', [AccessTokenController::class, 'issueToken']);
Route::get('/oauth/tokens', [AuthorizedAccessTokenController::class, 'forUser']);
Route::delete('/oauth/tokens/{token_id}', [AuthorizedAccessTokenController::class, 'destroy']);
Route::post('/oauth/token/refresh', [TransientTokenController::class, 'refresh']);

// ===============================
// TESTING ROUTE
// ===============================
Route::get('/', function () {
    return response()->json([
        'status' => true,
        'message' => 'Greenbiller.in welcomes you.',
        'data' => [
            'timestamp' => now()->toDateTimeString(),
        ],
    ]);
});

// ===============================
// Modular Routes (Versioned APIs)
// ===============================
Route::prefix('v1')->group(function () {
    Route::prefix('registration')->group(function () {
        require base_path('routes/user/api_registration.php');
    });
    Route::prefix('files')->group(function () {
        require base_path('routes/storage/api_storage.php');
    });
});
