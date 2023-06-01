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
 
       $vendor = Notification::where('vendor-id', $request->id)->first();
       return Api::setResponse('notification', $vendor);
    }
}
