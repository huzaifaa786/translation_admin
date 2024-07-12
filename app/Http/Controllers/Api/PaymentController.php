<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request){
        $stripe = new StripeClient('sk_test_51NM6X5DLEEzulrUBAjMmKrhfiWCaG26detVGc15yiL6H4VFb5hGhjg4hqud4ATSER3oC7pxLdq7fIMYlqBTiV7wC00UwuE2sPm');

        // Use an existing Customer ID if this is a returning customer.
        $customer = $stripe->customers->create();
        $ephemeralKey = $stripe->ephemeralKeys->create([
            'customer' => $customer->id,
        ], [
            'stripe_version' => '2022-08-01',
        ]);
        $intent = $stripe->paymentIntents->create([
            'amount' => $request->price * 100,
            'currency' => $request->currency,
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
              'publishableKey' => 'pk_test_51NM6X5DLEEzulrUBli8t2AqzUxlQ32XHEmZP1M2V1UnF4zSh1jJvGLkCPsOUyenBdP2DsrJt5swIiAYwc8V2MFnW00YshheMTw'
            ]
          );
          return Api::setResponse('intent',$paymentIntent);
    }
}
