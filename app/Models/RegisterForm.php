<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegisterForm extends Authenticatable
{
    protected $table = 'register_forms';

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'password', // ✅ ADD THIS
        'property_type',
        'demolition_type',
        'site_address',
        'ward_id',
        'latitude',
        'longitude',
        'built_up_area',
        'estimated_waste',
        'application_id',
        'status',
        'plant_id',
        'qr_code',
        'pdf_file'
    ];
    public function ward()
    {
        return $this->belongsTo(Ward::class);
    }

   
}

 
    