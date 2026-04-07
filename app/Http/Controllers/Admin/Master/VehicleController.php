<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index(){
       $vechiledata = Vehicle::all();
    return view('admin.master.vehicle.index',compact('vechiledata'));
     
    }
    public function show($id)
{
    $vehicle = Vehicle::findOrFail($id);

    return view('admin.master.vehicle.view', compact('vehicle'));
}
public function availableTickets()
{
    $tickets = Ticket::where('status', 'pending')->get();

    return view('vehiclepwa.tickets', compact('tickets'));
}

public function acceptTicket($id)
{
    $vehicleId = session('vehicle_user_id');

    $ticket = Ticket::findOrFail($id);

    if ($ticket->status != 'pending') {
        return back()->with('error', 'Already taken');
    }

    $ticket->update([
        'status' => 'processing',
        'vehicle_id' => $vehicleId
    ]);

    return back()->with('success', 'Ticket Accepted');
}

}
