<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request){
        $stripe = new StripeClient('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');

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
              'publishableKey' => 'pk_live_51MlTmPAN8zi2vyFsLuiIyZ2kKKBcDLPDU9SgGZau5mYJXSjSLzlEw4LvHRc0ztiT4rSl8nsBnKCU7nTvpuYsMu7u00wg6yt3km'
            ]
          );
          return Api::setResponse('intent',$paymentIntent);
    }
}
