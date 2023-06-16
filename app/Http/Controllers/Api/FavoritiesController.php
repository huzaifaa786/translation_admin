<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorities;
use Illuminate\Http\Request;

class FavoritiesController extends Controller
{
    public function store(Request $request)
    {
        $user_id = $request->input('user_id');
        $vendor_id = $request->input('vendor_id');
        
        // Check if the favorite entry already exists
        $existingFavorite = Favorities::where('user_id', $user_id)
            ->where('vendor_id', $vendor_id)
            ->first();
        
        if ($existingFavorite) {
            return response()->json(['message' => 'Favorite already exists']);
        }
        
        // Delete any existing favorite entry for the same user and vendor
        Favorities::where('user_id', $user_id)
            ->where('vendor_id', $vendor_id)
            ->delete();
        
        // Create a new favorite entry
        Favorities::create([
            'user_id' => $user_id,
            'vendor_id' => $vendor_id,
        ]);
        
        return response()->json(['message' => 'Favorite added successfully']);
    }
    
}    
