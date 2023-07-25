<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\NotificationHelper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {

        try {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'starttime' => Carbon::parse($request->starttime)->format('H:i:s'),
                'endtime' => Carbon::parse($request->endtime)->format('H:i:s'),
                'price' => $request->price,
                'date' => Carbon::parse($request->date)->toDateString(),
                'duration' => $request->duration,
                'meetingtype' => $request->meetingtype,
                'servicetype' => $request->servicetype,
                'scheduletype' => $request->scheduletype,
                'vendor_id' => $request->vendor_id,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
            ]);

            if ($request->servicetype == 'document') {

                Document::create([
                    'order_id' => $order->id,
                    'pages' => $request->pages,
                    'file' => $request->file,
                    'documenttype' => $request->documenttype,
                    'description' => $request->description


                ]);
            }
            $notification = Notification::create([

                'order_id' => $order->id,
                'vendor_id' => $request->vendor_id,


                'user_id' => Auth::user()->id,
                'title' => 'New order placed',
                'body' => 'Click to View',
                'for_vendor' => '1'
            ]);
            // $data = User::find(Auth::user()->id)->withfirebaseToken();

            // $token = $data->firebase_token;
            $vendor = Vendor::find($request->vendor_id);

            $vendor = $vendor->firebase_token;

            // NotificationHelper::send($notification, $token);
            NotificationHelper::vendor($notification, $vendor);

            return Api::setResponse('order', $order);
        } catch (\Throwable $th) {
            return Api::setError($th);
        }
    }
    public function allorder(Request $request)
    {

        $data = Order::where('user_id', $request->user_id)->with('document')->with('user')->with('vendor')->orderByDesc('created_at')->get();
        return Api::setResponse('order', $data);
    }
    public function vendororder(Request $request)
    {
        $vendor = Vendor::where('api_token', $request->api_token)->first();

        $data = Order::where('vendor_id', $vendor->id)
            ->with('document')
            ->with('user')
            ->with('vendor')

            ->orderByDesc('created_at')
            ->get();

        return Api::setResponse('order', $data);
    }
    public function accept(Request $request)
    {

        $order = Order::find($request->id);
        $order->status = 1;
        $order->save();
        $notification = Notification::create([
            'user_id' => $order->user_id,
            'vendor_id' => Auth::user()->id,
            'order_id' => $request->id,
            'for_user' => '1',
            // 'company_id' => $request->company_id,
            'title' => 'Your order has been accepted',
            'body' => 'Click to View',
            ''

        ]);



        $data = User::find($order->user_id)->withfirebaseToken();

        $token = $data->firebase_token;

        NotificationHelper::send($notification, $token);

        return Api::setResponse('orders', $order);
    }
    public function reject(Request $request)
    {
        $order = Order::find($request->id);

        $order->status = 2;
        $order->save();

        // if ($order->paymentmethod === 'wallet') {
        //     $user = Account::where('user_id', $request->user_id)->first();
        //     $user->balance += $order->totalpayment;
        //     $user->save();
        // }
        $notification = Notification::create([
            'user_id' => $order->user_id,
            'order_id' => $request->id,
            'vendor_id' => Auth::user()->id,
            'for_user' => '1',
            // 'company_id' => $request->company_id,
            'title' => 'Your order has been rejected and order amount was refunded',
            'body' => 'Click to View',
        ]);



        $data = User::find($order->user_id)->withfirebaseToken();

        $token = $data->firebase_token;

        NotificationHelper::send($notification, $token);

        return Api::setResponse('orders', $order);
    }
    public function complete(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 3;
        $order->save();
        $notification = Notification::create([
            'user_id' => $order->user_id,
            'order_id' => $request->id,
            'vendor_id' => Auth::user()->id,
            'for_user' => '1',
            // 'company_id' => $request->company_id,
            'title' => 'Your order has been completed',
            'body' => 'Click to View',
        ]);



        $data = User::find($order->user_id)->withfirebaseToken();

        $token = $data->firebase_token;

        NotificationHelper::send($notification, $token);
        return Api::setResponse('orders', $order);
    }

    public function orderrating(Request $request)
    {
        $data = Order::where('user_id', $request->user_id)
            ->with('document')
            ->with('user')
            ->with('vendor')
            ->orderByDesc('created_at')
            ->get();

        // Loop through each order and check if it has a rating
        foreach ($data as $order) {
            if ($order->status == 3) {
                // If the order status is 3, set has_rating to false and continue to the next order
                $order->has_rating = false;
                continue;
            }

            $rating = Rating::where('order_id', $order->id)->first();

            if ($rating === null) {
                // Add an additional key-value pair to indicate no rating
                $order->has_rating = false;
            } else {
                // Add the rating details to the order
                $order->rating = $rating;
                $order->has_rating = true;
            }
        }

        return Api::setResponse('order', $data);
    }
}
