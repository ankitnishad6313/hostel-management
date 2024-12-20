<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'image',
        'about',
        'address',
        'country',
        'twitter',
        'facebook',
        'instagram',
        'linkedin',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'added_by',
        'expires_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hostels()
    {
        return $this->hasMany(Hostel::class);
    }
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class);
    }
    public function popularHostel()
    {
        return $this->hasMany(PopularHostel::class);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function assignment(){
        $this->hasMany(Assignment::class);
    }

    public function getImageAttribute($value)
    {
        if ($value != NUll) {
            $image = url($value);
            return $image;
        } else {
            return url("/assets/img/avatar.webp");
        }
    }

    public function getAadharFrontAttribute($value)
    {
        return url("$value/");
    }
    public function getAadharBackAttribute($value)
    {
        return url("$value/");
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function setFatherNameAttribute($value)
    {
        $this->attributes['father_name'] = ucwords($value);
    }
    public function setMotherNameAttribute($value)
    {
        $this->attributes['mother_name'] = ucwords($value);
    }
    public function setGuardianNameAttribute($value)
    {
        $this->attributes['guardian_name'] = ucwords($value);
    }
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }
    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = ucwords($value);
    }

}
