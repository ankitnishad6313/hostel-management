<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory;
    
    use SoftDeletes;

    public function getImageAttribute($value){

        return url("$value");
    }

    protected $fillable = [
        'city',
        'image',
        'status',
    ];
}
