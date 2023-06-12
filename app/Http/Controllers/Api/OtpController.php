<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Mail;

class OtpController extends Controller




{
    public function sendopt(Request $request)
    {
        $data = User::where('email', $request->email)->first();
        if ($data != null) {
            $otp = random_int(1000, 9999);
            $mailData = [
                'title' => 'Teanslation-Request Change Password',
                'name' => $data->name,
                'otp' => $otp,
            ];

            Mail::to($request->email)->send(new OtpMail($mailData));
            return Api::setResponse('otp', $otp);
        } else {
            return Api::setError('user not exist on this email');
        }
    }

    public function forgetchange(Request $request)
    {

        $data = User::where('email', $request->email)->first();

        $data->update([
            'password' => $request->password
        ]);
        // toastr()->success('update successfully ');
        return Api::setResponse('update', $data);
    }
}
