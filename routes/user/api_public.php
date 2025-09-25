<?php

use App\Http\Controllers\Api\V1\Public\PublicController;
use Illuminate\Support\Facades\Route;

// ===============================
// Public Authentication Routes
// ===============================
Route::get('phone-code', [PublicController::class, 'getAppReferenceData'])->name('auth.getAppReferenceData');
