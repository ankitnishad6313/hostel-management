<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['package', 'price', 'validity', 'content'];

    public function assignment(){
        $this->hasMany(Assignment::class);
    }
}
