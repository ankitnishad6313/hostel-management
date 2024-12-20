<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'hostel_id',
        'name',
        'email',
        'phone',
        'description',
        'room_type',
    ];

    protected $casts = ['room_type'];

    public function hostel(){
        return $this->belongsTo(Hostel::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
