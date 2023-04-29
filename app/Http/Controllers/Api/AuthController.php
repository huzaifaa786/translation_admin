<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\ApiValidate;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function vendorregister(Request $request)
    {

        $credentials = ApiValidate::register($request, Vendor::class);
        $vendor = Vendor::find(Vendor::create($credentials)->id)->withToken();
        return Api::setResponse('Vendor', $vendor);


        
        // $response = new stdClass;
        // $response->user = $vendor->withToken();
        // // $response->otp = $otp;
        // return response()->json($response);
    }
    public function vendorlogin(Request $request)
    {

        $credentials = ApiValidate::login($request, Vendor::class);
        // $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials)) {
            $vendor = Vendor::find(Auth::guard('vendor')->vendor()->id);
            if ($vendor->status == 2) {
                return Api::setError('admin not prove your request');
            }
           
            return Api::setResponse('vendor', $vendor->withToken());
        } else {
            return Api::setError('Invalid credentials');
        }
    }
}
