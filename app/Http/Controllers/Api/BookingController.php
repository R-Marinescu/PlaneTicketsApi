<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;

class BookingController
{

    public function index() {
        $bookings = Booking::paginate(request('per_page', 15));

        return BookingResource::collection($bookings)->response();
    }

    public function show($bookingId) {
        $booking = Booking::findOrFail($bookingId);

        return (new BookingResource($booking))->response();
    }

    public function store(BookingRequest $request) {
        $booking = Booking::create([
            'passenger_id' => $request->input('passenger_id'),
            'flight_id' => $request->input('flight_id'),
            'status' => $request->input('status', 'pending'),
        ]);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => new BookingResource($booking)
            ], 201);
    }

    public function update(BookingRequest $request, $id) {
        $booking = Booking::findOrFail($id);

        $booking->update([
           'passenger_id' => $request->filled('passenger_id') ? $request->input('passenger_id') : $booking->passenger_id,
            'flight_id' => $request->filled('flight_id') ? $request->input('flight_id') : $booking->flight_id,
            'status' => $request->filled('status') ? $request->input('status') : $booking->status,
        ]);

        return response()->json([
            'message' => 'Booking updated successfully',
            'data' => new BookingResource($booking)
        ], 200);
    }

    public function destroy($id) {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully'], 200);
    }
}
