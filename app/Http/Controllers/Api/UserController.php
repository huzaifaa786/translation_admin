<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function userget(Request $request) {
    $user = User::where('api_token', $request->api_token)->first();
    return Api::setResponse('user', $user);
   }
   public function balanceget(Request $request) {

    $user = Account::where('user_id', $request->id)->first();
    return Api::setResponse('balance', $user);
   }


}
