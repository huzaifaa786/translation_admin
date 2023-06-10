<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [

        'order_id',
        'documenttype',
        'file', 'pages',
        'description'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function setfileatribute($file)
    {
        $this->attributes['file'] = FileHelper::saveFile($file);
    }
    public function getfileatribute($file)
    {
        if ($file)
            return asset($file);
        else
            return $file;
    }
}
