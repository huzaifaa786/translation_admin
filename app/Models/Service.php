<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id', 'schedual', 'urgent', 'unurgent', 'inperson',
         'audiovideo', 'urgentprice', 'unurgentprice','onlineaudiovideo','latitude','longitude','radius'
         
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id', 'vendor_id');
    }
}
