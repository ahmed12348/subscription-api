<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::get('/plans', [\App\Http\Controllers\PlanController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/checkout/stripe', [\App\Http\Controllers\CheckoutController::class, 'stripe']);
    Route::post('/checkout/paypal', [\App\Http\Controllers\CheckoutController::class, 'paypal']);
});
