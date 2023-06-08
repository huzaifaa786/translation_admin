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

    public function check()
    {
   
        $has_new = Notification::where('vendor_id',Auth::guard()->user()->id)->where('is_read', false)->count();
        if($has_new > 0)
            return Api::setResponse('exist',true);
        return Api::setResponse('exist',false);
    }
     public function userCheck()
    {
        $has_new = Notification::where('user_id',Auth::guard('api')->user()->id)->where('is_read', false)->count();
        if($has_new > 0)
            return Api::setResponse('exist',true);
        return Api::setResponse('exist',false);
    }
    public function read(Request $request)
    {
        $noitification = Notification::find($request->notification_id);
        if($noitification){
            $noitification->update([
                'is_read' => true
            ]);
            return Api::setMessage('notifcation read');
        }
            return Api::setMessage('notifcation not found');
    }
}
