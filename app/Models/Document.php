<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    public function setFileAttribute($file)
    {
        $this->attributes['file'] = FileHelper::saveFile($file);
    }
    public function getFileAttribute($file)
    {
        if ($file)
            return asset('storage/app/'.$file);
            // return  unlink(storage_path('app/'.$file));
        else
            return $file;
    }
}
