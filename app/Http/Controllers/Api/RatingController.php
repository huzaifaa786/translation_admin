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
        $existingRating = Rating::where('order_id', $request->order_id)->first();
        if ($existingRating) {
            return Api::setError('Rating');
        }
        $rating = Rating::create([
            'vendor_id' =>  $request->vendor_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,


        ]);
        return Api::setResponse('rating', $rating);
    }
    public function calculate(Request $request)
    {

        // PlaceRating::where('place_id',$id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;

           $rateArray =[];
        //    foreach ($rates as $rate)
        //    {
        //        $rateArray[]= $rate['rating'];
        //    }

            $sum = array_sum($rateArray);
            $result = $sum/5;

            return response()->json(['rating'=>$result],200);
    }
}
