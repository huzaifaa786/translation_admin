<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use App\Traits\Notifier;
use App\Traits\UserMethods;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use HasFactory, UserMethods, Notifiable, Notifier;
    protected $fillable = [
        'name',
        'username',
        'DOB',
        'passport',
        'certificate',
        'api_token',
        'password',
        'status',
        'language',
        'online',
        'number',
        'profilepic'

    ];
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',

    ];
    public function setPassportAttribute($value)
    {
        $this->attributes['passport'] = ImageHelper::saveImageFromApi($value, 'images');
    }
    public function setLanguageAttribute($value)
    {
        $this->attributes['language'] = json_encode($value);
    }
    public function getLanguageAttribute($value)
    {
        $this->attributes['language'] = json_decode($value);
    }
    public function setProfilepicAttribute($value)
    {
        $this->attributes['profilepic'] = ImageHelper::saveImageFromApi($value, 'images');
    }
    public function setCertificateAttribute($value)
    {
        $this->attributes['certificate'] = ImageHelper::saveImageFromApi($value, 'images');
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
}
