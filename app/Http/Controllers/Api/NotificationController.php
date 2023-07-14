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

        $vendor = Notification::where('vendor_id', $request->id)->where('for_vendor', 1)->with('user')->with('order')->orderByDesc('created_at')->get();
        return Api::setResponse('notifications', $vendor);
    }

    public function usernotification(Request $request)
    {
        $user = Auth::guard('api')->user()->id;
        $notification = Notification::where('user_id', $user)->where('for_user', 1)->with('vendor')->with('order')->orderByDesc('created_at')->get();
        
        return Api::setResponse('notifications', $notification);
    }

    public function check()
    {

        $has_new = Notification::where('vendor_id', Auth::guard('vendor_api')->user()->id)->where('is_read', false)->count();
        if ($has_new > 0)
            return Api::setResponse('exist', true);
        return Api::setResponse('exist', false);
    }
    public function userCheck()
    {
        $has_new = Notification::where('user_id', Auth::guard('api')->user()->id)->where('is_read', false)->count();
        if ($has_new > 0)
            return Api::setResponse('exist', true);
        return Api::setResponse('exist', false);
    }
    public function read(Request $request)
    {
        $vendorId = Auth::guard('vendor_api')->user()->id;

        $notifications = Notification::where('vendor_id', $vendorId)->get();

        if ($notifications->count() > 0) {
            $notifications->each(function ($notification) {
                $notification->update([
                    'is_read' => true
                ]);
            });

            return Api::setMessage('notifications read');
        }

        return Api::setMessage('notifications not found');
    }

    public function userread(Request $request)
    {
        $userid = Auth::guard('api')->user()->id;

        $notifications = Notification::where('user_id', $userid)->get();

        if ($notifications->count() > 0) {
            $notifications->each(function ($notification) {
                $notification->update([
                    'is_read' => true
                ]);
            });

            return Api::setMessage('notifications read');
        }

        return Api::setMessage('notifications not found');
    }


}
