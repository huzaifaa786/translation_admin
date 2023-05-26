<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $order = Order::create([
            'user_id' => Auth::user()->id,
        ] + $request->all());

        if ($request->documents && is_array($request->documents)) {
            foreach ($request->documents as $key => $document) {
                dd($document);
                Document::create([
                    'order_id' => $order->id,
                    'document' => $document,
                ]);
            }
        }

        return Api::setResponse('order', $order);
    }
}
