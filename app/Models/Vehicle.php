<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
    'ward_id','vehicle_number','vehicle_photo','vehicle_type','capacity',
    'rc_document','fitness_certificate',
    'owner_name','owner_mobile','owner_email','owner_address',
    'owner_photo','owner_aadhaar_number','owner_aadhaar_photo','password',
    'driver_same_as_owner','driver_name','driver_mobile','driver_address',
    'driver_license_number','driver_license_photo',
    'driver_aadhaar_number','driver_aadhaar_photo'
];
}
