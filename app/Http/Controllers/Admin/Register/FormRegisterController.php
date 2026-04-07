<?php

namespace App\Http\Controllers\Admin\Register;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisterForm;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;


class FormRegisterController extends Controller
{
    public function index(){
      
        $register = RegisterForm::all();

         return view('admin.register.index', compact('register'));
    }


      
    public function dashboardcount(){

    $count = RegisterForm::count();
    $activecount = RegisterForm::where('status', 'approved')->count(); 
    $pendingcount = RegisterForm::where('status', 'pending')->count(); 
     
      return view('admin.dashboard', compact('count','activecount','pendingcount'));
    }
   

public function approve($id)
{
    $register = RegisterForm::findOrFail($id);

    // ❗ Prevent re-approve
    if ($register->status === 'approved') {
        return back()->with('error', 'Already Approved');
    }

    // ✅ Step 1: Generate Application ID
    $applicationId = 'REG-' . date('Y') . '-' . str_pad($register->id, 5, '0', STR_PAD_LEFT);

    // ✅ Step 2: Assign & save
    $register->application_id = $applicationId;
    $register->save();

    // ✅ Ensure QR folder exists
    $qrFolder = public_path('qrcodes');
    if (!file_exists($qrFolder)) {
        mkdir($qrFolder, 0777, true);
    }

    // ✅ Step 3: Generate QR Code
    $renderer = new ImageRenderer(
        new RendererStyle(300),
        new SvgImageBackEnd()
    );

    $writer = new Writer($renderer);

    $qrCode = $writer->writeString((string) $applicationId); // ✅ FIX

    $qrPath = 'qrcodes/' . $applicationId . '.svg';
    file_put_contents(public_path($qrPath), $qrCode);

    // ✅ Step 4: Generate PDF
    $pdf = \PDF::loadView('pdf.application', compact('register'));
    $pdfPath = 'pdfs/' . $applicationId . '.pdf';
    $pdf->save(public_path($pdfPath));

    // ✅ Step 5: Final update
    $register->update([
        'status' => 'approved',
        'qr_code' => $qrPath,
        'pdf_file' => $pdfPath
    ]);

    return back()->with('success', 'Approved & Files Generated. ID: ' . $applicationId);
}

}
