<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function vendornotification(Request $request)
    {

        $vendor = Notification::where('vendor_id', $request->id)->where('for_vendor',1)->with('user')->with('order')->get();
        return Api::setResponse('notifications', $vendor);
    }

    public function usernotification(Request $request)
    {
        $user = Auth::user()->id;
        $notification = Notification::where('user_id', $user)->where('for_user',1)->with('vendor')->with('order')->get();
        return Api::setResponse('notifications', $notification);
    }
}
