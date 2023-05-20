<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function userget(Request $request) {
    $user = User::where('api_token', $request->api_token)->first();
    return Api::setResponse('user', $user);
   }
   public function balanceget(Request $request) {

    $user = User::where('user_id', $request->id)->first();
    return Api::setResponse('balance', $user);
   }


}
