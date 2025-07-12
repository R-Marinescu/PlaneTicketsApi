<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\AirportController;
use App\Http\Controllers\Api\FlightOriginController;
use App\Http\Controllers\Api\TestIndexController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [TestIndexController::class, 'home']);
    Route::post('payments/create-intent', [PaymentController::class, 'createIntent'])->name('payments.create-intent');
});

//User for testing purposes
Route::resource('users', UserController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'me']);
//Route::middleware(['auth:sanctum', 'admin'])->group(function () {
//    Route::resource('users', UserController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
//});

// Airport
Route::resource('airports', AirportController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Flights
Route::resource('flights', FlightController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Bookings
Route::resource('bookings', BookingController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Payments
Route::resource('payments', PaymentController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Roles
Route::resource('roles', RoleController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
