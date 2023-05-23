<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
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

        $data = Vendor::find($request->vendor_id);
        $data->profilepic = $request->profilepic;
        $data->save();
        // toastr()->success('update successfully ');
        return Api::setResponse('vendor', $data);
    }
    public function searchedList(Request $request,)
    {
        $vendors = Vendor::whereJsonContains('language', $request->form)
            ->whereJsonContains('language',  $request->to)->with('service')
            ->get();
        // toastr()->success('update successfully ');
        return Api::setResponse('vendor', $vendors);
    }
}
