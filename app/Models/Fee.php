<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    public function getPaymentModeAttribute($value){
        return ucwords(str_replace("_", " ", $value));
    }
}
