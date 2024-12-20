<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use HasFactory, SoftDeletes;

    public function hostel(){
        $this->belongsTo(Hostel::class);
    }
    public function user(){
        $this->belongsTo(User::class);
    }
    public function package(){
        $this->belongsTo(Package::class);
    }
}
