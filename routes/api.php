<?php

use App\Http\Controllers\Api\FlightController;
use App\Http\Controllers\Api\FlightOriginController;
use App\Http\Controllers\Api\PassengerController;
use App\Models\FlightDestination;
use Illuminate\Support\Facades\Route;

//Passengers
Route::resource('passengers', PassengerController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

//FlightOrigin
Route::resource('flight-origins', FlightOriginController::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// FlightDestination
Route::resource('flight-destinations', FlightDestination::class)->only(['index', 'show', 'store', 'update', 'destroy']);

// Flights
Route::resource('flights', FlightController::class)->only(['index', 'show', 'store', 'update', 'destroy']);


