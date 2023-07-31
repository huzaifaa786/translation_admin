<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function show()
    {

        $data = Vendor::all();
        return view('admin.vendor.newvendor', ['vendors' => $data]);
    }
    public function reject($id)
    {

        $vendor = Vendor::find($id);
        $vendor->status = 2;
        $vendor->save();
        return redirect()->back();
    }
    public function aprove($id)
    {

        $vendor = Vendor::find($id);
        $vendor->status = 1;
        $vendor->save();
        return redirect()->back();
    }
    
    public function disable($id)
    {
        $vendor = Vendor::find($id);
        $vendor->status = 0;
        $vendor->save();
        return redirect()->back();
    }
    public function all()
    {

        $data = Vendor::whereIn('status', [1, 2])->get();
        return view('admin.vendor.allvendor', ['vendors' => $data]);
    }
}
