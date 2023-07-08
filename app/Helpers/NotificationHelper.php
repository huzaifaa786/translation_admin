<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationHelper
{

    public static function send($object, $token)
    {

        $notification['to'] = $token;
        $notification['notification']['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $notification['notification']['title'] = $object->title;
        $notification['notification']['body'] = $object->body;

        $notification['data'] = $object->extra;

        $result = Http::withOptions(['json' => $notification])
            ->withHeaders(["authorization" => "key=AAAASltq_bk:APA91bGjN2bNeIEustpmWF8KSVEEyCehFIYeOdxkkfXoJWqeG52I0XXLjVyLKn59Ee-ZDwvnl6_rogeXkcVjVzMH5yGQx810aJehUbqt-yB0heCERwrHFERb0b-DbNc4MXQQwP5KhRmO"])
            ->post("https://fcm.googleapis.com/fcm/send");

        Log::alert($result);
    }
    public static function vendor($object, $vendor)
    {
        dd($vendor);
        $notification['to'] = $vendor;
        $notification['notification']['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $notification['notification']['title'] = $object->title;
        // $notification['notification']['body'] = $object->body;

        $notification['data'] = $object->extra;

        $result = Http::withOptions(['json' => $notification])
            ->withHeaders(["authorization" => "key=AAAA2uxSS1k:APA91bHyVW9KCOHBfrdP69zzwcdQYx4Hw7WH-kE_KRScGUjvgOFerv95ZewGFxXX2NTc5hHVku07jWMoxbyyRgLLlLxLjQ8QKmV-lOIZqhxORgCyAm2k9rAJHf48xwIL-sFtthMi8r6c"])
            ->post("https://fcm.googleapis.com/fcm/send");

        Log::alert($result);
    }
}
