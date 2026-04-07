<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class VehiclepwaController extends Controller
{
  public function index()
{
    $vehicleId = session('vehicle_user_id'); // ✅ correct key

    if (!$vehicleId) {
        return redirect()->route('vehicle.login');
    }

    $vehicle = Vehicle::find($vehicleId);

    return view('vehiclepwa.dashboard', compact('vehicle'));
}


     
}
