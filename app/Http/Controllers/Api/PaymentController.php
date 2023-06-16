<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request){
        $stripe = new StripeClient('sk_test_51NIouOGymMbhwQk2gFEXvnieRWvcu1qiYYEx3ZqMblb8Fh1XtMdF5oHAmwb1uBPEKcM1BDwMHWajBpSagSJFGqFS00asmwpNUe');

        // Use an existing Customer ID if this is a returning customer.
        $customer = $stripe->customers->create();
        $ephemeralKey = $stripe->ephemeralKeys->create([
            'customer' => $customer->id,
        ], [
            'stripe_version' => '2022-08-01',
        ]);
        $intent = $stripe->paymentIntents->create([
            'amount' => $request->price * 100,
            'currency' => 'aed',
            'customer' => $customer->id,
            'automatic_payment_methods' => [
                'enabled' => true,
            ],

        ]);
        $paymentIntent = json_encode(
            [
              'paymentIntent' => $intent->client_secret,
              'ephemeralKey' => $ephemeralKey->secret,
              'customer' => $customer->id,
              'intent' => $intent,
              'publishableKey' => 'pk_test_51NIouOGymMbhwQk2cR0e4YSnF0qlR3dWnLW7UpKVnGmJROS0xVhSNh2DQE4VZgn9MzosxPrXHEhGfwig77xJKmng003qpA3ffH'
            ]
          );
          return Api::setResponse('intent',$paymentIntent);
    }
}
