<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
     protected $fillable = [
        'plant_name',
        'address',
        'ward_id',
        'longitude',
        'latitude',
        'owner_name',
        'mobile',
        'email',
        'password',
        'status'
    ];

    protected $hidden = ['password'];
}
