<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = ['deleted_at'];

    public function getImageAttribute($value){
        return url("/$value");
    }
    public function getCreatedAtAttribute($value){
        return date("d-M-Y H:i:s", strtotime($value));
    }
    public function getUpdatedAtAttribute($value){
        return date("d-M-Y H:i:s", strtotime($value));
    }
}
