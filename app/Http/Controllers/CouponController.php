<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function shows()
    {

        $data = Company::all();
        return view('Admin.copen.copen', ['companys' => $data]);
    }
    public function store(Request $request)
    {

        Coupon::create($request->all());
        return redirect()->back();
    }
    public function delete($id)
    {

        $product = Coupon::find($id);

        $product->delete();
        // toastr()->success('Delete successfully ');
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $city = Coupon::find($id);

        $city->update($request->all());
        // toastr()->success('update successfully ');
        return redirect()->back();
    }
    public function show()
    {

        $data = Coupon::all();
        return view('admin.coupon.create', ['copens' => $data]);

}
}
