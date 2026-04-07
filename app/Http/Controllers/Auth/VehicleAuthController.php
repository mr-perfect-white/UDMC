<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;

class VehicleAuthController extends Controller
{

  // Show Login Page
    public function showLogin()
    {
        return view('auth.vehicle-login');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'mobile' => 'required',
            'password' => 'required'
        ]);

        $user = Vehicle::where('owner_mobile', $request->mobile)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // Store session
            session([
                'vehicle_user_id' => $user->id,
                'vehicle_user_name' => $user->owner_name
            ]);

           return redirect()->route('vehicle.dashboard');
        }

        return back()->with('error', 'Invalid Mobile or Password');
    }


     

    public function logout()
{
    session()->flush();
    return redirect()->route('vehicle.login');
}
    
}
