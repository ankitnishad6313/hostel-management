<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hostel(){
        return $this->belongsTo(Hostel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
