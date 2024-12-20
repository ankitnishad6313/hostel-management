<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = ['room_id', 'bed_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function bed()
    {
        return $this->belongsTo(Bed::class);
    }
}
