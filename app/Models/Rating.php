<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [

        'vendor_id',

        'order_id',
        'rating'

    ];

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }
}
