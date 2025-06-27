<?php

namespace App\Services;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeService
{
    public function __construct() {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent($amount, $currency = 'usd') {
        return PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => $currency,
            'payment_method_types' => ['card'],
        ]);
    }
}
