<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterForm;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        $wards = Ward::orderBy('number')->get();
        return view('frontend.register', compact('wards'));
    }

    public function status(Request $request)
{
    
    $applicationId = $request->application_id ?? $request->name;

    $register = null;

    if ($applicationId) {
        $register = RegisterForm::where('application_id', $applicationId)->first();
    }

    return view('frontend.status', compact('register', 'applicationId'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|digits:10',
            'email' => 'required|email',
            'property_type' => 'required',
            'site_address' => 'required',
            'ward_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'built_up_area' => 'required',
            'estimated_waste' => 'required',
        ]);

        

        // ✅ Step 1: Save as pending
        $register = RegisterForm::create([
            ...$request->all(),
             'password' => Hash::make($request->mobile), // simple password
            'status' => 'pending'
        ]);

        // ✅ Step 2: Calculate amount
        $waste = $request->estimated_waste;

        $amount = ($waste * 134) + ($waste * 770) + ($waste * 196);
        $amountPaise = $amount * 100;

        // ✅ Step 3: Create Razorpay order (FIXED)
        $api = new \Razorpay\Api\Api(
            config('services.razorpay.key'),
            config('services.razorpay.secret')
        );

        $order = $api->order->create([
            'receipt' => 'order_' . $register->id,
            'amount' => (int) $amountPaise,
            'currency' => 'INR'
        ]);

        // ✅ Step 4: Save order id
        $register->update([
            'razorpay_order_id' => $order['id']
        ]);

        // ✅ Step 5: Redirect to payment page
        return view('frontend.payment', compact('order', 'register', 'amount'));
    }


    
public function approve(Request $request, $id)
{
    $request->validate([
        'plant_id' => 'required'
    ]);

    $register = RegisterForm::findOrFail($id);

    // ❗ Prevent re-approve
    if ($register->status === 'approved') {
        return back()->with('error', 'Already Approved');
    }

    $applicationId = $register->application_id;

    // ✅ Step 3: Generate QR Code
    $qrPath = 'qrcodes/' . $applicationId . '.png';

    \QrCode::size(300)->generate(
        $applicationId,
        public_path($qrPath)
    );

    // ✅ Step 4: Generate PDF
    $pdf = \PDF::loadView('pdf.application', compact('register'));
    $pdfPath = 'pdfs/' . $applicationId . '.pdf';
    $pdf->save(public_path($pdfPath));

    // ✅ Step 5: Update final data
    $register->update([
        'status' => 'approved',
        'plant_id' => $request->plant_id,
        'qr_code' => $qrPath,
        'pdf_file' => $pdfPath
    ]);

    return back()->with('success', 'Application Approved Successfully. ID: ' . $applicationId);
}


public function login(Request $request)
{
    $request->validate([
        'email' => 'required',
        'password' => 'required'
    ]);

    // Email OR Mobile login
    $field = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

    if (Auth::attempt([$field => $request->email, 'password' => $request->password])) {
        return redirect()->route('registeruser.dashboard');
    }

    return back()->with('error', 'Invalid login details');
}


public function logout()
{
    Auth::logout();
    return redirect()->route('registeruser.login');
}


public function dashboard()
{
    $user = Auth::user();

    // Get all registers of this user
    $registers = RegisterForm::where('email', $user->email)->get();

    return view('frontend.registeruserdashboard', compact('user', 'registers'));
}
public function ticket()
{
     $user = Auth::user();

    // Get all registers of this user
    $registers = RegisterForm::where('email', $user->email)->get();
    return view('frontend.ticket', compact('user', 'registers'));
}
public function storeticket(Request $request)
{
    $request->validate([
        'register_id' => 'required|exists:register_forms,id',
        'quantity' => 'required|numeric|min:0.01',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // ✅ Get Register safely
    $register = RegisterForm::findOrFail($request->register_id);

    // ✅ Upload Photo
    $photoPath = null;
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('tickets', 'public');
    }

    // ✅ Create Ticket
    Ticket::create([
        'register_id' => $register->id,
        'application_id' => $register->application_id, // safe from DB
        'quantity' => $request->quantity,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
        'photo' => $photoPath,
        'status' => 'pending'
    ]);

    return back()->with('success', 'Ticket Created Successfully');
}


}