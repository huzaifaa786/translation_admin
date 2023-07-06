<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Api;
use App\Http\Controllers\Controller;
use App\Models\Favorities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritiesController extends Controller
{
    public function store(Request $request)
    {
        // dd('dfdfdf');
        // dd(Auth::guard('api')->user()->id);
        $user_id = Auth::guard('api')->user()->id;

        $vendor_id = $request->input('vendor_id');

        // Check if the favorite entry already exists
        $existingFavorite = Favorities::where('user_id', $user_id)
            ->where('vendor_id', $vendor_id)
            ->first();

        if ($existingFavorite) {
            $existingFavorite->delete();
            return response()->json(['message' => 'vendor will be unFavorite']);
        }

        // Delete any existing favorite entry for the same user and vendor
        Favorities::where('user_id', $user_id)
            ->where('vendor_id', $vendor_id)
            ->delete();

        // Create a new favorite entry
        $data = Favorities::create([
            'user_id' => $user_id,
            'vendor_id' => $vendor_id,
        ]);


        return Api::setResponse('favorities', $data);
    }

    public function userCheck(Request $request)
    {
        $user = Auth::guard('api')->user();
        if ($user && $request->has('vendor_id')) {
            $check = Favorities::where('user_id', $user->id)->where('vendor_id', $request->vendor_id)->exists();
            if ($check) {
                return Api::setResponse('favourit', true);
            }
        }
        return Api::setResponse('favourit', false);
    }
    
    public function getfavorities(Request $request)
    {

        $vendor = Favorities::where('user_id', Auth::guard('api')->user()->id)->with('vendor')->with('rating')->orderByDesc('created_at')->get();
        return Api::setResponse('vendors', $vendor);
    }

    public function checkfavorit(Request $request)
    {

        $vendor = Favorities::where('user_id', Auth::guard('api')->user()->id)->where('vendor_id', $request->id)->first();
        return Api::setResponse('vendor', $vendor);
    }
}
