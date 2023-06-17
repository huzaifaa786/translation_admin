<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function offline(Request $request)
    {
        $vendor = Vendor::where('api_token', $request->api_token)->first();
        $vendor->online = $request->online == 'true' ? true : false;
        $vendor->save();

        return Api::setResponse('Vendor', $vendor);
    }

    public function all()
    {
        $data = Vendor::where('status', 1)->get();
        return Api::setResponse('Vendor', $data);
    }

    public function show(Request $request)
    {
        $vendor = Vendor::where('api_token', $request->api_token)->first();

        return Api::setResponse('Vendor', $vendor);
    }

    public function edit(Request $request,)
    {
        $vendor = Vendor::where('api_token', $request->api_token)->first();

        $vendor->update($request->all());
        return Api::setResponse('vendor', $vendor);
        // toastr()->success('update successfully ');

    }
    public function searchedList(Request $request)
    {
        $vendors = Vendor::whereJsonContains('language', $request->form)
            ->whereJsonContains('language',  $request->to)
            ->where('status', 1)
            ->has('service') // Add this line to filter vendors with services
            ->with('service')
            ->with('isUserFavourite')
            ->withAvg('rating', 'rating')  // Load the ratings with average rating
            ->get();
            
        return Api::setResponse('vendor', $vendors);
    }
    
    
    public function addbalance(Request $request)
    {

        $data = Account::where('user_id', $request->id)->first();
        $data->update([
            'balance' => $request->balance + $data->balance
        ]);

        return Api::setResponse('account', $data);
    }
   


}
