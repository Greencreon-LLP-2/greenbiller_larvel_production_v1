<?php

use App\Http\Controllers\Api\V1\User\RegistrationApiController;
use Illuminate\Support\Facades\Route;

Route::post('/send-otp', [RegistrationApiController::class, 'sendOtp']);
Route::post('/register', [RegistrationApiController::class, 'register']);
Route::post('/login', [RegistrationApiController::class, 'login']);
Route::post('/logout', [RegistrationApiController::class, 'logout'])->middleware('auth:api');
