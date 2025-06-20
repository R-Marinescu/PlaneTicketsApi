<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\FlightOriginRequest;
use App\Http\Resources\FlightOriginResource;
use App\Models\FlightOrigin;

class FlightOriginController
{
    public function index() {
        $flightOrigin = FlightOrigin::paginate(request('per_page', 15));

        return FlightOriginResource::collection($flightOrigin)->response();
    }

    public function show($flightOriginId) {
        $flightOrigin = FlightOrigin::findOrFail($flightOriginId);

        return (new FlightOriginResource($flightOrigin))->response();
    }

    public function store(FlightOriginRequest $request) {
        $flightOrigin = FlightOrigin::create([
            'airport' => $request->input('airport'),
            'country' => $request->input('country'),
            'city' => $request->input('city'),
        ]);

        return response()->json([
            'message' => 'Flight origin created successfully',
            'data' => new FlightOriginResource($flightOrigin)
        ], 201);
    }

    public function update(FlightOriginRequest $request, $id) {
        $flightOrigin = FlightOrigin::findOrFail($id);

        $flightOrigin->update([
            'airport' => $request->filled('airport') ? $request->input('airport') : $flightOrigin->airport,
            'country' => $request->filled('country') ? $request->input('country') : $flightOrigin->country,
            'city' => $request->filled('city') ? $request->input('city') : $flightOrigin->city,
        ]);

        return response()->json([
            'message' => 'Flight origin updated successfully',
            'data' => new FlightOriginResource($flightOrigin)],
            200);
    }

    public function destroy($id) {
        $flightOrigin = FlightOrigin::findOrFail($id);

        $flightOrigin->delete();

        return response()->json(['message' => 'Flight origin deleted successfully'], 200);
    }
}
