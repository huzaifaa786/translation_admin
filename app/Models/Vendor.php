<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Traits\Notifier;
use App\Traits\UserMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Vendor extends Authenticatable
{
    use HasFactory, UserMethods, Notifiable, Notifier;
    protected $fillable = [
        'name',
        'username',
        'DOB',
        'passport',
        'certificate',
        'certifcate_name',
        'api_token',
        'password',
        'status',
        'language',
        'online',
        'profile',
        'number',
        'profilepic',
        'firebase_token',
        'about(Eng)',
        'about(arabic)',
        'cvImage',
        'email',
        'currency',

    ];
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',


    ];

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
    public function setPassportAttribute($value)
    {
        $this->attributes['passport'] = ImageHelper::saveImageFromApi($value, 'images');
    }


    public function setProfilepicAttribute($value)
    {
        $this->attributes['profilepic'] = ImageHelper::saveImageFromApi($value, 'images');
    }
    public function setCertificateAttribute($value)
    {
        $this->attributes['certificate'] = ImageHelper::saveImageFromApi($value, 'images');
    }

    public function setCvimageAttribute($value)
    {
        $this->attributes['cvImage'] = ImageHelper::saveImageFromApi($value, 'images');
    }

    public function setCertificateNameAttribute($value)
    {
    }
    public function getPassportAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }
    public function getCertificateAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }
    public function getProfilepicAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }

    public function getCvimageAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }
    public function service()
    {
        return $this->hasOne(Service::class, 'vendor_id', 'id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function vendor()
    {
        return $this->hasMany(Vendor::class);
    }

    public function notification()
    {
        return $this->hasMany(Notification::class);
    }

    public function rating()
    {

        return $this->hasMany(Rating::class);
    }

    public function favorities()
    {
        return $this->belongsTo(Favorities::class);
    }
}
