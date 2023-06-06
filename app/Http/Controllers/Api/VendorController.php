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
            ->with('service')
            ->with('rating') // Load the ratings
            ->get();
            
        // Calculate the average rating for each vendor
        $vendors->each(function ($vendor) {
            $averageRating = $vendor->rating->avg('rating');
            $vendor->averageRating = $averageRating;
        });
    
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
