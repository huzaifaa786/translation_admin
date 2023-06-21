<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function coupon(Request $request)
    {
        $coupons = Coupon::where('copen', $request->coupon)->first;

        if ($coupons == null) {
            return Api::setResponse('error', 'Coupon not exist');
        }
        return Api::setResponse('coupons', $coupons);
    }
}
