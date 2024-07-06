<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\NotificationHelper;
use App\Helpers\TimeZoneHelper;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Rating;
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
                'starttime' => Carbon::parse($request->starttime)->setTimezone('UTC')->format('H:i:s'),
                'endtime' => Carbon::parse($request->endtime)->setTimezone('UTC')->format('H:i:s'),
                'price' => $request->price,
                'date' => Carbon::parse($request->date)->setTimezone('UTC')->toDateString(),
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
                'for_vendor' => '1',
                'for_user' => '1',
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

 // Assuming you have the necessary classes and dependencies imported/defined.

 public function orderrating(Request $request)
 {
     // Retrieve the latest order for the specified user with status 3
     $order = Order::where('user_id', $request->user_id)
         ->where('status', 3)
         ->with('vendor')->with('user')
         ->latest('created_at')
         ->first();

     // Check if the order exists
     if ($order) {
         // Check if the order has a rating
         $rating = Rating::where('order_id', $order->id)->first();

         // Add the 'has_rating' flag to the order
         if ($rating === null) {
             $order->has_rating = false;
         } else {
             $order->has_rating = true;
         }

         // Return the order (with the 'has_rating' flag) as the API response
         return Api::setResponse('order', $order);
     } else {
         // Return an error response if the order doesn't exist
         return Api::setResponse('error', 'No order found with the specified criteria.', 404);
     }
 }



}
