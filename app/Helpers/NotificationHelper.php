<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NotificationHelper
{

    public static function send($object,$token)
    {

        $notification['to'] = $token;
        $notification['notification']['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $notification['notification']['title'] = $object->title;
        $notification['notification']['body'] = $object->body;

        $notification['data'] = $object->extra;

        $result = Http::withOptions(['json' => $notification])
            ->withHeaders(["authorization" => "key=AAAAK5yoMRI:APA91bFkWrvWmOQscYvpGMzupeJnaMkwIAY-6v8UF-zMys6mRgGKLjz6Z3bDeqq7mhM-4a-JU7OU-w_B69jIP87FRn5aZUEj6uI0bm3LjkungwK5r04FOYYyxxU4c7s0mYVgqV0bebJt"])
            ->post("https://fcm.googleapis.com/fcm/send");

            Log::alert($result);
    }
    public static function vendor($object,$vendor)
    {

        $notification['to'] = $vendor;
        $notification['notification']['click_action'] = "FLUTTER_NOTIFICATION_CLICK";
        $notification['notification']['title'] = $object->title;
        $notification['notification']['body'] = $object->body;

        $notification['data'] = $object->extra;

        $result = Http::withOptions(['json' => $notification])
            ->withHeaders(["authorization" => "key=AAAA7FuNmsw:APA91bEYtnOK4Xa7todqDVR_IK7u_A3aqS5xDtXtcJ94u42wQS9qIwMInkok75UEcgxy0b9qvxvXV13zUYTwoJNIMYkEFlCY3gQUMQAbG8F57xs6uNo4cKBJ1hUyqx1yX9-jzvbrCYH5"])
            ->post("https://fcm.googleapis.com/fcm/send");

            Log::alert($result);
    }
}
