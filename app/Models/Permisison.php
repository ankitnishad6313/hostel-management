<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisison extends Model
{
    use HasFactory;

    protected $casts = [
        'permissions' => 'array',
    ];
}
