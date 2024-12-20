<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'document_name', 'document_image_front', 'document_image_back'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);      
    }

    public function setDocumentNameAttribute($value){
        $this->attributes['document_name'] = ucwords($value);
    }

    public function getDocumentImageFrontAttribute($value){
        return asset("storage/$value/");
    }
    public function getDocumentImageBackAttribute($value){
        if($value == null){
            return url('assets/img/no-image-available-icon.png');
        }
        return asset("storage/$value/");
    }
}
