<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getBannerAttribute($value){
        return url("/$value");
    }

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
}
