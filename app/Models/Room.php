<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['room_status'];
    
    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function bed()
    {
        return $this->hasMany(Bed::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFloorAttribute($value){
        return ucfirst($value);
    }
}
