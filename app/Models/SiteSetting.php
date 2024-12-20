<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function getLogoAttribute($value){
        return url("/$value");
    }

    public function getFaviconAttribute($value){
        return url("/$value");
    }
    
}
