<?php

namespace App\Traits;

use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Hash;

trait UserMethods
{

    public static function registerRules()
    {
        return [
            'name' => 'max:255|required',
            'email' => 'email|required|unique:users',
            // 'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            // 'password_confirmation' => 'min:6'

        ];
    }

    public static function UserRegisterRules()
    {
        return [
            'username' => 'max:255|required',
            'email' => 'email|required|unique:users',
         
            'phone' => 'numeric|required',
        ];
    }

    public static function VendorRegisterRules()
    {
        return [
         
          
            'username' => 'required|unique:vendors',
            'password' => 'min:6|required',
         
        ];
    }

    public static function loginRules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }
    public static function userloginRules()
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }

    // public function setImageAttribute($value){
    //     if(is_file($value)){
    //         $this->attributes['image'] = ImageHelper::saveImage($value,'images/profile');
    //     } else if (!empty($value)){
    //         $this->attributes['image'] = $value;
    //     }
    // }

    // public function getImageAttribute($value){
    //     return asset($value);
    // }


    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function withToken()
    {
        return $this->makeVisible(['api_token']);
    }
    public function withpassword()
    {
        return $this->makeVisible(['password']);
    }
    public function withfirebaseToken()
    {
        return $this->makeVisible(['firebase_token']);
    }
}
