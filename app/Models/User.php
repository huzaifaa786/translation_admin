<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Traits\Notifier;
use App\Traits\UserMethods;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{


    use HasFactory, UserMethods, Notifiable, Notifier;
    protected $fillable = [

        'username',
        'email',
        'phone',
        'api_token',
        'password',
        'profilepic',
        'firebase_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'firebase_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function account()
    {
        return $this->hasOne(Account::class);
    }
    public function setprofilepicAttribute($value)
    {
        $this->attributes['profilepic'] = ImageHelper::saveImageFromApi($value, 'images');
    }
    public function getprofilepicAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function notification()
    {
        return $this->hasMany(Notification::class);
    }
  
}
