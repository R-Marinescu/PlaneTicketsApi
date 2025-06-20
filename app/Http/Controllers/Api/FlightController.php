<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FlightRequest;
use App\Http\Resources\FlightResource;
use App\Models\Flight;

class FlightController
{
    public function index() {
        $flights = Flight::paginate(request('per_page', 15));

        return FlightResource::collection($flights)->response();
    }

    public function show($flightId) {
        $flight = Flight::findOrFail($flightId);

        return (new Flightresource($flight))->response();
    }

    public function store(FlightRequest $request) {
        $flight = Flight::create([
            'flight_number' => $request->input('flight_number'),
            'origin_id' => $request->input('origin_id'),
            'destination_id' => $request->input('destination_id'),
        ]);

        return response()->json([
            'message' => 'Flight created successfully',
            'data' => new Flightresource($flight)
        ],  201);
    }

    public function update(FlightRequest $request, $id) {
        $flight = Flight::findOrFail($id);

        $flight->update([
            'flight_number' => $request->filled('flight_number') ? $request->input('flight_number') : $flight->flight_number,
            'origin_id' => $request->filled('origin_id') ? $request->input('origin_id') : $flight->origin_id,
            'destination_id' => $request->filled('destination_id') ? $request->input('destination_id') : $flight->destination_id,
        ]);

        return response()->json([
            'message' => 'Flight updated successfully',
            'data' => new Flightresource($flight)], 200);
    }

    public function destroy($id) {
        $flight = Flight::findOrFail($id);

        $flight->delete();

        return response()->json(['message' => 'Flight deleted successfully'], 200);
    }

}
