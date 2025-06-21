<?php

use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\FlightDestinationController;
use App\Http\Controllers\Api\FlightOriginController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\PaymentController;
use Illuminate\Support\Facades\Route;

//Passengers
Route::resource('passengers', PassengerController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

//FlightOrigin
Route::resource('flight-origins', FlightOriginController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// FlightDestination
Route::resource('flight-destinations', FlightDestinationController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Flights
Route::resource('flights', FlightController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Bookings
Route::resource('bookings', BookingController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Payments
Route::resource('payments', PaymentController::class)->only(['index', 'show', 'store', 'update', 'destroy']);
