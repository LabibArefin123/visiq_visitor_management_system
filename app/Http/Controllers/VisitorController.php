<?php

namespace App\Http\Controllers;

use App\Models\BlacklistedVisitor;
use App\Models\EmergencyVisitor;
use App\Models\PendingVisitor;
use App\Models\Visitor;
use App\Models\VisitorEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\VisitorWhatsApp;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::orderBy('id', 'asc')->paginate(10);
        return view('visitor_management.visitor.index', compact('visitors'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitor_management.visitor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|unique:visitors,visitor_id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'purpose' => 'required|string',
            'visit_date' => 'required|date',
            'date_of_birth' => 'required|date',
            'national_id' => 'required|string|max:255',
            'gender' => 'required|string',
        ]);

        Visitor::create($request->all());

        return redirect()->route('visitors.index')->with('success', 'Visitor added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitor_management.visitor.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitor_management.visitor.edit', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'visitor_id' => 'required|unique:visitors,visitor_id,' . $id,
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'nullable|email',
            'purpose' => 'required|string',
            'visit_date' => 'required|date',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:255',
            'gender' => 'nullable|string',
        ]);

        $visitor = Visitor::findOrFail($id);
        $visitor->update($request->all());

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully!');
    }

    public function generateGuestCard()
    {
        return view('visitor_management.visitor_guest_card');
    }


    public function printVisitor($id)
    {
        $visitor = Visitor::findOrFail($id); // Assuming Visitor is the model
        return view('visitor_management.visitor_management_print', compact('visitor'));
    }

    // Handle Form Submission


    public function approve($id)
    {
        $pendingVisitor = PendingVisitor::findOrFail($id);

        // Create Visitor Log Entry
        Visitor::create($pendingVisitor->toArray());

        // Delete from Pending Visitors
        $pendingVisitor->delete();

        return redirect()->route('visitor_management');
    }

    public function downloadBlankPDF()
    {
        $pdf = Pdf::loadView('visitor_management.visitor_blank_pdf');
        return $pdf->download('visitor_blank_form.pdf');
    }

    public function downloadBlankWord()
    {
        $content = view('visitor_management.visitor_blank_word')->render();
        $headers = [
            "Content-type" => "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "Content-Disposition" => "attachment;Filename=visitor_blank_form.doc",
        ];

        return response($content, 200, $headers);
    }

    public function generateTempQRCode(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'purpose' => 'required|string|max:255',
        ]);

        // Generate a unique token and construct the QR code URL
        $token = Str::random(10);
        $url = route('visitor_qr_submit', ['token' => $token]);

        // Store the temporary visitor data in the session or database for validation
        session()->put("temp_qr_{$token}", [
            'name' => $request->name,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'expires_at' => now()->addMinutes(30),
        ]);

        return response()->json([
            'success' => true,
            'code' => $url,
        ]);
    }

    public function scanQRCode(Request $request)
    {
        $qrCode = DB::table('temporary_qr_codes')
            ->where('code', $request->code)
            ->where('used', false)
            ->where('expires_at', '>=', Carbon::now())
            ->first();

        if (!$qrCode) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired QR code.'], 400);
        }

        // Mark QR code as used
        DB::table('temporary_qr_codes')->where('id', $qrCode->id)->update(['used' => true]);

        return response()->json(['success' => true, 'message' => 'QR code successfully used.']);
    }

    public function processQRCode($token)
    {
        // Retrieve and validate the temporary data
        $visitorData = session()->get("temp_qr_{$token}");

        if (!$visitorData || now()->greaterThan($visitorData['expires_at'])) {
            return response()->json(['success' => false, 'message' => 'QR code expired or invalid.'], 400);
        }

        // Save data to the database
        Visitor::create([
            'name' => $visitorData['name'],
            'phone' => $visitorData['phone'],
            'purpose' => $visitorData['purpose'],
            'visit_date' => now(),
        ]);

        // Remove the session data
        session()->forget("temp_qr_{$token}");

        return response()->json(['success' => true, 'message' => 'Visitor added successfully.']);
    }

    public function visitorQRIndex()
    {
        $visitors = Visitor::all();
        return view('visitor_management.visitor_qr_codes', compact('visitors'));
    }

    public function showQRCode($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->qr_code_url = route('visitor.checkin', ['id' => $visitor->id]);

        // Pass the visitor as a collection (array)
        $visitors = collect([$visitor]);

        return view('visitor_management.visitor_qr_code_section', compact('visitors'));
    }

    public function generateQRCodePDF($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Create QR Code Object
        $qrCode = new QrCode(route('visitor.checkin', ['id' => $visitor->id]));

        // Use PngWriter to generate the PNG output
        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        // Set the correct MIME type for the QR Code image
        header('Content-Type: ' . $result->getMimeType());

        // Output the raw binary data for the QR code image (if required for other uses)s

        // Save the generated QR code to a file (optional)
        $result->saveToFile(public_path('qrcodes/' . $visitor->id . '_qrcode.png'));

        // Generate the data URI to include image data inline in the PDF
        $dataUri = $result->getDataUri();

        // Pass the data URI and visitor data to the PDF view
        $pdf = Pdf::loadView('visitor_management.visitor_qr_code_section', compact('visitor', 'dataUri'));

        // Return the PDF for download
        return $pdf->download("Visitor_QR_{$visitor->id}.pdf");
    }

    public function checkIn($id)
    {
        $visitor = Visitor::findOrFail($id);
        return view('visitor_management.visitor_qr_code_checkedin', compact('visitor'));
    }

    public function downloadQrCodePdf($id)
    {
        $visitor = Visitor::findOrFail($id);

        // Generate the HTML view
        $html = view('visitor_management.qr_code_pdf', compact('visitor'))->render();


        // Convert to PDF
        $pdf = Pdf::loadHTML($html);

        return $pdf->download('visitor_qr_code.pdf');
    }

    public function sendQRCodeToWhatsApp($visitorId)
    {
        $visitor = Visitor::findOrFail($visitorId);

        // Check if visitor is already in visitor_whatsapp table
        $existingEntry = VisitorWhatsApp::where('visitor_id', $visitorId)->first();
        if (!$existingEntry) {
            VisitorWhatsApp::create([
                'visitor_id' => $visitor->id,
                'national_id' => $visitor->national_id,
                'name' => $visitor->name,
                'phone' => $visitor->phone,
                'email' => $visitor->email,
            ]);
        }

        // WhatsApp API Integration should be here

        return response()->json([
            'success' => true,
            'message' => 'QR Code sent to WhatsApp successfully!',
        ]);
    }

    public function sendQRCodeToEmail($visitorId)
    {
        $visitor = Visitor::findOrFail($visitorId);

        // Check if visitor exists in the visitor_emails table
        $existingEntry = VisitorEmail::where('visitor_id', $visitorId)->first();

        if ($existingEntry) {
            // Update the timestamp to the current time
            $existingEntry->touch();
        } else {
            // Create a new entry if it doesn't exist
            VisitorEmail::create([
                'visitor_id' => $visitor->id,
                'national_id' => $visitor->national_id,
                'name' => $visitor->name,
                'phone' => $visitor->phone,
                'email' => $visitor->email,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'QR Code sent to email successfully!']);
    }
}
