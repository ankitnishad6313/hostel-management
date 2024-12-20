<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hostel extends Model
{
    use HasFactory,SoftDeletes;

    protected $casts = ['hostel_images','hostel_features'];

    public function getHostelFeaturesAttribute($value)
    {
        return json_decode($value, true);
    }
    public function getHostelImagesAttribute($value)
    {
       $arr = json_decode($value, true);

        if ($arr != null) {
            // If $arr is a string, convert it into an array
            if (is_string($arr)) {
                $arr = [$arr];
            }
        
            foreach ($arr as $image) {
                $hostel_images[] = url("uploads/hostel_image/$image");
            }
        
            return $hostel_images;
        } else {
            return $arr;
        }

    }

    public function setHostelFeaturesAttribute($value)
    {
        $this->attributes['hostel_features'] = json_encode($value);
    }
    public function setHostelImagesAttribute($value)
    {
        $this->attributes['hostel_images'] = json_encode($value);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->hasMany(Room::class);
    }
    public function bookings() {
        return $this->hasManyThrough(Booking::class, Room::class);
    }
    public function bed()
    {
        return $this->hasMany(Bed::class);
    }
    public function enquiry()
    {
        return $this->hasMany(Enquiry::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function popularHostel()
    {
        return $this->hasMany(PopularHostel::class);
    }

    public function assignment(){
        $this->hasMany(Assignment::class);
    }
    
    public function getPropertyTypeAttribute($value){
        return ucfirst($value);
    }

    public function getGenderTypeAttribute($value){
        return ucfirst($value);
    }



}
