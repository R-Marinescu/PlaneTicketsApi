<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController
{
    public function index() {
        $payments = Payment::paginate(request('per_page', 15));

        return PaymentResource::collection($payments)->response();
    }

    public function show($paymentId) {
        $payment = Payment::findOrFail($paymentId);

        return (new PaymentResource($payment))->response();
    }

    public function store(PaymentRequest $request) {
        $payment = Payment::create([
            'booking_id' => $request->input('booking_id'),
            'amount' => $request->input('amount'),
            'status' => $request->input('status', 'pending'),
        ]);

        return response()->json([
            'message' => 'Payment created successfully',
            'data' => new PaymentResource($payment)
        ], 201);
    }

    public function update(PaymentRequest $request, $id) {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'booking_id' => $request->filled('booking_id') ? $request->input('booking_id') : $payment->booking_id,
            'amount' => $request->filled('amount') ? $request->input('amount') : $payment->amount,
            'status' => $request->filled('status') ? $request->input('status') : $payment->status,
        ]);

        return response()->json([
            'message' => 'Payment updated successfully',
            'data' => new PaymentResource($payment)
        ], 200);
    }

    public function destroy($id) {
        $payment = Payment::findOrFail($id);

        $payment->delete();

        return response()->json(['message' => 'Payment deleted successfully'], 200);
    }
}
