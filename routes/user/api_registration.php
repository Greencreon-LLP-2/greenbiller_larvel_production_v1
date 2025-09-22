<?php

use App\Http\Controllers\Api\V1\User\RegistrationApiController;
use Illuminate\Support\Facades\Route;

// ===============================
// Public Authentication Routes
// ===============================
Route::post('/auth/send-otp', [RegistrationApiController::class, 'sendOtp'])->name('auth.sendOtp');
Route::post('/auth/register', [RegistrationApiController::class, 'register'])->name('auth.register');
Route::post('/auth/login', [RegistrationApiController::class, 'login'])->name('auth.login');
Route::get('/auth/check-user', [RegistrationApiController::class, 'checkUserExistence'])->name('auth.checkUser');

// ===============================
// Admin Routes (role 1 only) - Most specific first
// ===============================
Route::middleware(['auth:api', 'role:1'])->group(function () {
    Route::delete('/admin/users/{id}', [RegistrationApiController::class, 'adminUserDelete'])->name('admin.users.delete');
});

// ===============================
// User Routes (Authenticated: roles 4,5,6)
// ===============================
Route::middleware(['auth:api', 'role:4,5,6'])->group(function () {
    Route::post('/auth/logout', [RegistrationApiController::class, 'logout'])->name('auth.logout');
    Route::patch('/users/status', [RegistrationApiController::class, 'statusUpdate'])->name('users.status.update');
});

// ===============================
// Authenticated User Profile Routes (All authenticated users)
// ===============================
Route::middleware(['auth:api'])->group(function () {
    Route::get('/users/profile', [RegistrationApiController::class, 'getProfile'])->name('users.profile.show');
    Route::post('/users/profile', [RegistrationApiController::class, 'updateProfile'])->name('users.profile.update');
});