<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_content',
        'about_image',
        'mission_content',
        'mission_image',
        'message_content',
        'message_image',
        'what_we_do_content',
        'what_we_do_image'
    ];

    public function getAboutImageAttribute($value){
        $image =  url('/') . "/$value";
        return $image;
    }
    public function getMissionImageAttribute($value){
        $image =  url('/') . "/$value";
        return $image;
    }
    public function getMessageImageAttribute($value){
        $image =  url('/') . "/$value";
        return $image;
    }
    public function getWhatWeDoImageAttribute($value){
        $image =  url('/') . "/$value";
        return $image;
    }
}
