<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

// -----------------------------
// ✅ API Routes Start Here
// -----------------------------
Route::prefix('api')->middleware('api')->group(function () {

    // 🔓 Public APIs
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // 🔐 Authenticated (Customer) APIs
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/services', [ServiceController::class, 'index']);
        Route::post('/bookings', [BookingController::class, 'store']);
        Route::get('/bookings', [BookingController::class, 'userBookings']);

        // 👮‍♂️ Admin-only APIs (assuming you have 'is_admin' middleware)
        Route::middleware('is_admin')->group(function () {
            Route::post('/services', [ServiceController::class, 'store']);
            Route::put('/services/{id}', [ServiceController::class, 'update']);
            Route::delete('/services/{id}', [ServiceController::class, 'destroy']);
            Route::get('/admin/bookings', [BookingController::class, 'allBookings']);
        });
    });
});
