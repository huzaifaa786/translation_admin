<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function vendornotification(Request $request)
    {
 
       $vendor = Notification::where('vendor_id', $request->id)->with('userr')->with('order')->get();
       return Api::setResponse('notifications', $vendor);
    }
}
