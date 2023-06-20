<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    
    public function show(Request $request)
    {
        
       $data= Account::where('user_id',Auth::guard('api')->user()->id)->first();
        return Api::setResponse('account', $data);
    }

    public function add(Request $request)
    {
       $data= Account::where('user_id',$request->id)->first();
       $data->update([
        'balance' => $request->balance + $data->balance
    ]);

        return Api::setResponse('account', $data);
    }
    public function subtract(Request $request)
    {
       $data= Account::where('user_id',$request->id)->first();
       $data->update([
        'balance' => $data->balance-$request->balance
    ]);

        return Api::setResponse('account', $data);
    }
}
