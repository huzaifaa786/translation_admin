<?php

namespace App\Models;

use App\Helpers\ImageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bug extends Model
{
    use HasFactory;
    protected $fillable = [

        'user_id',
        'bug',
        'picture'


    ];
    public function setpictureAttribute($value)
    {
        $this->attributes['picture'] = ImageHelper::saveImageFromApi($value, 'images');
    }
    public function getpictureAttribute($value)
    {
        if ($value)
            return asset($value);
        else
            return $value;
    }
}
