<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'servicetype',
        'price',
        'starttime',
        'endtime',
        'status',
        'vendor_id',
        'date',
        'duration',
        'scheduletype',
        
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }
}
