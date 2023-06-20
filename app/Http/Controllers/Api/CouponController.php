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
        $coupons = Coupon::all();
        return Api::setResponse('coupons', $coupons);
    }
}
