<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
class VehicleRegisterController extends Controller
{
 
 public function index(){


  $wards = Ward::orderBy('number')->get();

        return view('frontend.vehicleregister', compact('wards'));
   
 }


 public function store(Request $request)
{
    
    $request->validate([
        'vehicle_number' => 'required',
        'owner_mobile' => 'required|unique:vehicles',
        'password' => 'required|min:6',
        'rc_document' => 'required|file|mimes:jpg,jpeg,png,pdf',
    'fitness_certificate' => 'required|file|mimes:jpg,jpeg,png,pdf',
    ]);
    

    // Upload files
    $vehiclePhoto = $request->file('vehicle_photo')->store('uploads', 'public');

    // Save
    $vehicle = Vehicle::create([
        'ward_id' => $request->ward_id,
        'vehicle_number' => $request->vehicle_number,
        'vehicle_photo' => $vehiclePhoto,
        'vehicle_type' => $request->vehicle_type,
        'capacity' => $request->capacity,
        'rc_document' => $request->file('rc_document')->store('uploads', 'public'),
        'fitness_certificate' => $request->file('fitness_certificate')->store('uploads', 'public'),

        'owner_name' => $request->owner_name,
        'owner_mobile' => $request->owner_mobile,
        'owner_email' => $request->owner_email,
        'owner_address' => $request->owner_address,
        'owner_photo' => $request->file('owner_photo')->store('uploads', 'public'),
        'owner_aadhaar_number' => $request->owner_aadhaar_number,
        'owner_aadhaar_photo' => $request->file('owner_aadhaar_photo')->store('uploads', 'public'),

        'password' => Hash::make($request->password),

        'driver_same_as_owner' => $request->driver_same_as_owner,
        'driver_name' => $request->driver_name,
        'driver_mobile' => $request->driver_mobile,
        'driver_address' => $request->driver_address,
        'driver_license_number' => $request->driver_license_number,
        'driver_license_photo' => $request->file('driver_license_photo')->store('uploads', 'public'),
        'driver_aadhaar_number' => $request->driver_aadhaar_number,
        'driver_aadhaar_photo' => $request->file('driver_aadhaar_photo')->store('uploads', 'public'),
    ]);

    // ✅ Send WhatsApp
    $this->sendWhatsapp($vehicle->owner_mobile, $request->password);

    return redirect()->back()->with('success', 'Registered Successfully');
    
}

public function sendWhatsapp($mobile, $password)
{
    $data = [
        "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY4M2Q1N2UxYjQ4ZmJiMGMwZDA3OTZmOSIsIm5hbWUiOiJCU1dNTCAtIEJFTkdBTFVSVSBTT0xJRCBXQVNURSBNQU5BR0VNRU5UIExJTUlURUQiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjgzZDU3ZTFiNDhmYmIwYzBkMDc5NmYyIiwiYWN0aXZlUGxhbiI6Ik5PTkUiLCJpYXQiOjE3NDg4NTA2NTd9.NKkUEZb3iBr3c-A4SbQbm-oOB7h0BZ2CJAdipP8_ijk",
        "campaignName" => "UDMS_Logins",
        "destination" => $mobile,
        "userName" => "BSWML",
        "templateParams" => [
            $mobile,
            $password,
            $mobile,
            $password,
            $mobile
        ],
        "source" => "form",
    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://backend.api-wa.co/campaign/mcware/api/v2");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    curl_exec($ch);
    Log::info('WhatsApp Response: ' . $response);
    curl_close($ch);
}

}
