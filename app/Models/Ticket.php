<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'register_id',
        'application_id',
        'quantity',
        'latitude',
        'longitude',
        'photo',
        'status',
        'vehicle_id'
    ];


     public function register()
    {
        return $this->belongsTo(RegisterForm::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
