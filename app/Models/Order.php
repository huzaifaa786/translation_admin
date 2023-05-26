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
        'documenttype',
        'status',
        'vendor_id'
        
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function document()
    {
        return $this->hasOne(Document::class);
    }
}
