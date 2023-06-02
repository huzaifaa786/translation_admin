<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Helpers\ApiValidate;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function vendorregister(Request $request)
    {

        $credentials = ApiValidate::register($request, Vendor::class);
        $vendor = Vendor::find(Vendor::create($credentials)->id)->withToken();

        return Api::setResponse('Vendor', $vendor);



        $response = new stdClass;
        $response->vendor = $vendor->withToken();
        // $response->otp = $otp;
        return response()->json($response);
    }
    public function vendorlogin(Request $request)
    {
        $credentials = ApiValidate::login($request, Vendor::class);
        // $credentials = $request->only('email', 'password');

        if (Auth::guard('vendor')->attempt($credentials)) {
            $vendor = Vendor::find(Auth::guard('vendor')->user()->id);
            $vendor->firebase_token = $request->firebase_token;
            $vendor->save();
            if ($vendor->status == 2) {
                return Api::setError('admin reject your request');
            } else if ($vendor->status == 0) {
                return Api::setError('Your account is inactive yet');
            }

            return Api::setResponse('vendor', $vendor->withToken());
        } else {
            return Api::setError('Invalid credentials');
        }
    }
    //////////////////user///////////////////////////////////\\\\\\/////\\\\\////\\\\///\\\//\\/\
    public function userregister(Request $request)
    {

        $credentials = ApiValidate::userregister($request,  User::class);
        $User = User::find(User::create($credentials)->id)->withToken();
        Account::create([

            'user_id' => $User->id,

        ]);
        return Api::setResponse('Vendor', $User);



        $response = new stdClass;
        $response->vendor = $User->withToken();
        // $response->otp = $otp;
        return response()->json($response);
    }
    public function userlogin(Request $request)
    {
        $credentials = ApiValidate::userlogin($request, User::class);
        // $credentials = $request->only('email', 'password');

        if (Auth::guard('web')->attempt($credentials)) {
            $User = User::find(Auth::guard('web')->user()->id);
            // $User->firebase_token = $request->firebase_token;
            // $User->save();

            return Api::setResponse('User', $User->withToken());
        } else {
            return Api::setError('Invalid credentials');
        }
    }

    public function changeuserpassword(Request $request)
    {

        $data = User::where('api_token', $request->api_token)->first();

        $data = $data->withpassword();
        $previousPassword = $data->password;

        // dd($new,$previousPassword);

        if (Hash::check($request->password, $previousPassword)) {
            $data->update([
                'password' => $request->newpassword
            ]);
            // Passwords match
            return Api::setResponse('update', $data);
        } else {
            // Passwords do not match
            return Api::setError('Current password incorrect');
        }
    }
    public function changevendorrpassword(Request $request)
    {

        $data = Vendor::where('api_token', $request->api_token)->first();

        $data = $data->withpassword();
        $previousPassword = $data->password;

        // dd($new,$previousPassword);

        if (Hash::check($request->password, $previousPassword)) {
            $data->update([
                'password' => $request->newpassword
            ]);
            // Passwords match
            return Api::setResponse('update', $data);
        } else {
            // Passwords do not match
            return Api::setError('Current password incorrect');
        }
    }
}
