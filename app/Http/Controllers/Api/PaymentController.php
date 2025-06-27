<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Booking;
use App\Models\Payment;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController
{

    protected $stripe;

    public function __construct(StripeService $stripe) {
        $this->stripe = $stripe;
    }

    public function createIntent(PaymentRequest $request) {
        $validated = $request->validated();

        $booking = Booking::where('id', $validated['booking_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        try {
            $intent = $this->stripe->createPaymentIntent(
                $validated['amount'],
                $validated['currency'] ?? 'usd'
            );

            $booking->payment()->create([
                'stripe_payment_intent_id' => $intent->id,
                'amount' => $validated['amount'],
                'currency' => $validated['currency'] ?? 'usd',
                'status' => $intent->status,
            ]);

            return response()->json([
               'client_secret' => $intent->client_secret,
                'amount' => $intent->amount,
                'currency' => $intent->currency,
                'status' => $intent->status,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create payment intent',
                'message' => $e->getMessage()
            ], 500);
        }
    }

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
