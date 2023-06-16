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
        $user_id = Auth::user()->id;
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
        $data =Favorities::create([
            'user_id' => $user_id,
            'vendor_id' => $vendor_id,
        ]);
        
      
        return Api::setResponse('favorities', $data);
    }
    
}    
