<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        ' vendor_id', 'schedual'

    ];
    public function vendor()
    {
      return $this->hasMany(Vendor::class);
}
}
