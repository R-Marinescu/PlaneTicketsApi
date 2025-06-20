<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FlightDestinationRequest;
use App\Http\Resources\FlightDestinationResource;
use App\Models\FlightDestination;

class FlightDestinationController
{

    public function index() {
        $flightDestinations =
            FlightDestination::paginate(request('per_page', 15));

        return FlightDestinationResource::collection($flightDestinations)->response();
    }

    public function show($flightDestinationId) {
        $flightDestination = FlightDestination::findOrFail($flightDestinationId);

        return (new FlightDestinationResource($flightDestination))->response();
    }

    public function store(FlightDestinationRequest $request) {

        $flightDestination = FlightDestination::create([
            'airport' => $request->input('airport'),
            'country' => $request->input('country'),
            'city' => $request->input('city')
        ]);

        return response()->json([
            'message' => 'Flight destination created successfully',
            'data' => new FlightDestinationResource($flightDestination)
        ], 201);
    }

    public function update(FlightDestinationRequest $request, $id) {
        $flightDestination = FlightDestination::findOrFail($id);

        $flightDestination->update([
            'airport' => $request->filled('airport') ? $request->input('airport') : $flightDestination->airport,
            'country' => $request->filled('country') ? $request->input('country') : $flightDestination->country,
            'city' => $request->filled('city') ? $request->input('city') : $flightDestination->city,
        ]);

        return response()->json([
            'message' => 'Flight destination updated successfully',
            'data' => new FlightDestination($flightDestination),],
            200);
    }

    public function destroy($id) {
        $flightDestination = FlightDestination::findOrFail($id);

        $flightDestination->delete();

        return response()->json([
            'message' => 'Flight destination was deleted successfully'], 200);
    }
}
