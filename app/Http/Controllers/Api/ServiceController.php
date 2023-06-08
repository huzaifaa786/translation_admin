<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $vendor = Service::where('vendor_id', $request->vendor_id)->first();
    
        if ($vendor) {
            // Vendor already has a service, so update it
            $vendor->update($request->all());
            $data = $vendor;
        } else {
            // Vendor doesn't have a service, create a new one
            $data = Service::create($request->all());
        }
    
        return Api::setResponse('services', $data);
    }
    
       public function change(Request $request)
    {

        $data = Vendor::where('username', $request->username)->first();

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
            return Api::setResponse('error', 'Current password incorrect');
        }

    }
    public function serviceget(Request $request)
    {
        $vendor = Service::where('vendor_id', $request->id)->first();
        return Api::setResponse('service', $vendor);
    }
}
