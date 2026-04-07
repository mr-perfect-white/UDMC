<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterForm;
use App\Models\Ward;

class RegisterController extends Controller
{
    public function index()
    {
        $wards = Ward::orderBy('number')->get();
        return view('frontend.register', compact('wards'));
    }

    public function status()
    {
        return view('frontend.status');
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

    // ✅ Step 1: Generate Application ID
    $applicationId = 'REG-' . date('Y') . '-' . str_pad($register->id, 5, '0', STR_PAD_LEFT);

    // ✅ Step 2: Save Application ID first
    $register->update([
        'application_id' => $applicationId
    ]);

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
}