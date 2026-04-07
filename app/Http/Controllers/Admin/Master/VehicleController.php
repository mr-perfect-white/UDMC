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


}
