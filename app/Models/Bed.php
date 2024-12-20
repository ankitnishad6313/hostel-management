<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['hostel_id', 'room_id', 'bed_name', 'bed_status'];
    
    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    
    public function booking()
    {
        return $this->hasMany(Booking::class);
    }
}
