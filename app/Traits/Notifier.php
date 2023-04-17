<?php

namespace App\Traits;

use App\Helpers\ImageHelper;
use Exception;

trait Notifier {

    public function setImageAttribute($value){
        if(is_file($value)){
            $this->attributes['image'] = ImageHelper::saveImage($value,'images/notifications');
        }else if(is_string($value)){
            $this->attributes['image'] = $value;
        }
    }

    public function getImageAttribute($value){
        $trimmed = substr($value, 0, 5);
        if($trimmed == 'http://' || $trimmed == 'https://')
            return $value;
        else
            return asset($value);
    }

    public function  send()
    {
        $notification['to'] = $this->firebase_token;
        $notification['notification']['title'] = $this->title;
        $notification['notification']['body'] = $this->body;

        $notification['notification']['badge'] = "1";
        $notification['notification']['sound'] = "default";
        $notification['notification']['icon'] = "";
        $notification['notification']['image'] = $this->image;
        $notification['notification']['type'] = "";

        $notification['data']['title'] = $this->title;
        $notification['data']['body'] = $this->body;
        $notification['data']['icon'] = "";
        $notification['data']['senderid'] = "";
        $notification['data']['receiverid'] = "";
        $notification['data']['action_type'] = "";
        try{
            $this->sendPushNotification(json_encode($notification));
        } catch (Exception $e){

        }
    }

    public function sendPushNotification($notification)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $notification,
            CURLOPT_HTTPHEADER => array(
                "authorization: key= AAAAJlzmAGI:APA91bGKga6FlRlcl-5DEOgugudeJxTI9QR03JPpL4d1Sr9JNn0JBQmnXwzqnF0Wd23KD1Ey8BSRfilWR_RpWi04L73n3wbpzXsjJC1HVmzmiNPQwk0RGyMAez6ukb6L1tkJJnVvh6P1",
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 85f96364-bf24-d01e-3805-bccf838ef837"
            ),
        ));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
    }
}
