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
            ->withHeaders(["authorization" => "key=AAAAqimwxso:APA91bFINzYvYnYCpVuD8SqkgBzwEd0QoKk7ciR5qVreFaVf6c-YvbEaOMDOk8DhSEdeQ0TmbbT9XkZesiJ4dlpQ2D19O1XFMM-PQBnxrzMjmPKpjlw6vuYSPCMn-H1417-z--J5NdUQ"])
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
