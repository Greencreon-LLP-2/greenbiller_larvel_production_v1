<?php

use App\Http\Controllers\Api\V1\User\RegistrationApiController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/send-otp', [RegistrationApiController::class, 'sendOtp']);
Route::post('/register', [RegistrationApiController::class, 'register']);
Route::post('/login', [RegistrationApiController::class, 'login']);

// Protected routes for normal users (roles 4,5,6)
Route::middleware(['auth:api', 'role:4,5,6'])->group(function () {
    Route::post('/logout', [RegistrationApiController::class, 'logout']);
    Route::patch('/status', [RegistrationApiController::class, 'statusUpdate']);
  
});
// Admin routes (role 1)
Route::middleware(['auth:api', 'role:1'])->group(function () {
    Route::delete('/admin-delete', [RegistrationApiController::class, 'adminUserdelete']);
});
  