<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $fillable = [

'name',
'mobile',
'email',

'property_type',
'demolition_type',

'site_address',
'ward_id',

'latitude',
'longitude',

'built_up_area',
'estimated_waste',

'processing_charges',
'transportation_charges',
'administrative_charges',
'total_amount'

];
}
