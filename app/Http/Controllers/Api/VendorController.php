<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function offline(Request $request)
    {

        $vendor = Vendor::find($request->id);
        $vendor->online = $request->u == 'online' ? true : false;
        $vendor->save();
        return redirect()->back();
    }
}
