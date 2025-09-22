<?php
use App\Http\Controllers\Api\V1\Storage\SecureFileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:api'])->group(function () {
 Route::get('/{folder}/{filename}', [SecureFileController::class, 'fetch']);
});
 
