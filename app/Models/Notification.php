<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'title',
        'body',
        'sent',
        'vendor_id',
        'is_read',
        'user_id',
        'read_at'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class)->with('user');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
