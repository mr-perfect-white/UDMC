<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Ticket;
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

    $tickets = Ticket::where('status', 'pending')->get();

    return view('vehiclepwa.dashboard', compact('vehicle', 'tickets'));

   
}

public function acceptTicket($id)
{
    $vehicleId = session('vehicle_user_id');

    $ticket = Ticket::findOrFail($id);

    if ($ticket->status !== 'pending') {
        return back()->with('error', 'Already accepted');
    }

    $ticket->update([
        'vehicle_id' => $vehicleId,
        'status' => 'processing'
    ]);

    return back()->with('success', 'Ticket Accepted');
}

public function pickup(){

   return view('vehiclepwa.pickup');

}


public function dump(){

   return view('vehiclepwa.dump');

}


public function history(){

   return view('vehiclepwa.history');

}



public function ticketlist()
{
    $user = Auth::user();

    $tickets = Ticket::whereHas('register', function ($q) use ($user) {
        $q->where('email', $user->email);
    })->get();

    return view('frontend.ticketlist', compact('tickets'));
}


     
}
