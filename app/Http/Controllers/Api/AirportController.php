<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AirportRequest;
use App\Http\Resources\AirportResource;
use App\Models\Airport;

class AirportController
{

    public function index() {
        $airports =
            Airport::paginate(request('per_page', 15));

        return AirportResource::collection($airports)->response();
    }

    public function show($airportId) {
        $airport = Airport::findOrFail($airportId);

        return (new AirportResource($airport))->response();
    }

    public function store(AirportRequest $request) {

        $airport = Airport::create([
            'name' => $request->input('name'),
            'iata_code' => $request->input('iata_code'),
            'country' => $request->input('country'),
            'city' => $request->input('city')
        ]);

        return response()->json([
            'message' => 'Airport created successfully',
            'data' => new AirportResource($airport)
        ], 201);
    }

    public function update(AirportRequest $request, $id) {
        $airport = Airport::findOrFail($id);

        $airport->update([
            'name' => $request->filled('name') ? $request->input('name') : $airport->airport,
            'iata_code' => $request->filled('iata_code') ? $request->input('iata_code') : $airport->airport,
            'country' => $request->filled('country') ? $request->input('country') : $airport->country,
            'city' => $request->filled('city') ? $request->input('city') : $airport->city,
        ]);

        return response()->json([
            'message' => 'Airport updated successfully',
            'data' => new Airport($airport),],
            200);
    }

    public function destroy($id) {
        $airport = Airport::findOrFail($id);

        $airport->delete();

        return response()->json([
            'message' => 'Airport was deleted successfully'], 200);
    }
}
