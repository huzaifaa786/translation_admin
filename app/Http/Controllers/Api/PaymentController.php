<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\StripeClient;
class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request){
        $stripe = new StripeClient('sk_test_51MlTmPAN8zi2vyFsoj42hG3Ogz0rbxcPcbMBYhQ0dYurBHb0cpNmoDgcKioY4dkZeG55asSuZIpkKn1Ftyys4kqx00hbq1myWM');

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
              'publishableKey' => 'pk_test_51MlTmPAN8zi2vyFswyWqxxJKbe8NnGRtoOo55Z2P65V8EykUYWk034zKSkXkh2THsQZ6OYZzdoQOUxXmSmPiPz9G00dQnMo69A'
            ]
          );
          return Api::setResponse('intent',$paymentIntent);
    }
}
