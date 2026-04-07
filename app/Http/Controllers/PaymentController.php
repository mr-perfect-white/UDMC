<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class PaymentController extends Controller
{
 
use App\Models\RegisterForm;

public function paymentSuccess(Request $request)
{
    $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

    try {
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature
        ]);

        $register = RegisterForm::findOrFail($request->register_id);

        // ✅ Generate Application ID AFTER payment
        $applicationId = 'REG-' . date('Y') . '-' . str_pad($register->id, 5, '0', STR_PAD_LEFT);

        $register->update([
            'status' => 'paid',
            'application_id' => $applicationId,
            'razorpay_payment_id' => $request->razorpay_payment_id
        ]);

        return response()->json(['status' => 'success']);

    } catch (\Exception $e) {
        return response()->json(['status' => 'failed']);
    }
}

 
}