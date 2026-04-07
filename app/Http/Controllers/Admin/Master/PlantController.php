<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ward;
use App\Models\Plant;

use Illuminate\Support\Facades\Hash;
class PlantController extends Controller
{
    public function index(){
        $plantdeatils = Plant::all();
        return view('admin.master.plant',compact('plantdeatils'));
    }

    public function create(){
          $wards = Ward::orderBy('number')->get();
        return view('admin.master.createplant',compact('wards'));
    }
    public function toggle($id)
    {
        $plant = Plant::findOrFail($id);
        $plant->status = $plant->status == 1 ? 0 : 1;
        $plant->save();

        return back();
    }

    public function store(Request $request)
{
    $request->validate([
        'plant_name' => 'required',
        'address' => 'required',
        'longitude' => 'required',
        'latitude' => 'required',
        'owner_name' => 'required',
        'mobile' => 'required',
        'email' => 'required|email|unique:plants,email',
        'password' => 'required|min:6',
    ]);

    Plant::create([
        'plant_name' => $request->plant_name,
        'address' => $request->address,
        'ward_id' => $request->ward_id,
        'longitude' => $request->longitude,
        'latitude' => $request->latitude,
        'owner_name' => $request->owner_name,
        'mobile' => $request->mobile,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'status' => 'inactive', // default
    ]);

    return redirect()->back()->with('success', 'Plant Registered Successfully!');
}
}