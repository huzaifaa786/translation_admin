<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rating(Request $request)
    {
        $rating = Rating::create([
            'vendor_id' =>  $request->vendor_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,


        ]);
        return Api::setResponse('rating', $rating);
    }
}
