<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PassengerRequest;
use App\Http\Resources\PassengerResource;
use App\Models\Passenger;

class PassengerController
{
    public function index() {
        $passengers = Passenger::paginate(request('per_page', 15));

        return PassengerResource::collection($passengers)->response();
    }

    public function show($passengerId) {
        $passenger = Passenger::findOrFail($passengerId);

        return (new PassengerResource($passenger))->response();
    }

    public function store(PassengerRequest $request) {

        $passenger = Passenger::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return response()->json(['message' => 'Passenger created successfully', 'data' => new PassengerResource($passenger)], 201);
    }

    public function update(PassengerRequest $request, $id){
        $passenger = Passenger::findOrFail($id);

        $passenger->update([
            'first_name' => $request->filled('first_name') ? $request->input('first_name') : $passenger->first_name,
            'last_name' => $request->filled('last_name') ? $request->input('last_name') : $passenger->last_name,
            'email' => $request->filled('email') ? $request->input('email') : $passenger->email,
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $passenger->password,
        ]);

        return response()->json([
            'message' => 'Passenger updated successfully',
            'data' => new PassengerResource($passenger)], 200);
    }

    public function destroy($id) {
        $passenger = Passenger::findOrFail($id);

        $passenger->delete();

        return response()->json(['message' => 'Passenger deleted successfully'], 200);
    }

}
