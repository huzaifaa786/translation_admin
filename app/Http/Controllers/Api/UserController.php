<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Bug;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function userget(Request $request)
   {
      $user = User::where('api_token', $request->api_token)->first();
      return Api::setResponse('user', $user);
   }
   public function balanceget(Request $request)
   {

      $user = Account::where('user_id', $request->id)->first();
      return Api::setResponse('balance', $user);
   }
   public function edituser(Request $request)
   {

      $user = user::where('api_token', $request->api_token)->first();

      $user->update($request->all());
      return Api::setResponse('user', $user);
   }
   public function addbug(Request $request)
   {
      $user = Bug::create($request->all());

      return Api::setResponse('balance', $user);
   }
   public function updatePreferredCurrency(Request $request, User $user)
   {
      $request->validate([
         'currency' => 'required|string',
      ]);

      $user->currency = $request->currency;
      $user->save();

      // return response()->json(['message' => 'Preferred currency updated successfully'], 200);
      return Api::setResponse('currency', $user);
   }
}
