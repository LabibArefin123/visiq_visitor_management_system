<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\VisitorCompany;
use App\Models\VisitorGroupMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;

class VisitorCompanyController extends Controller
{
    public function company()
    {
        // Fetch visitors with the type "group"
        $companies = VisitorCompany::where('visitor_type', 'group')->get();

        // Count unique company names (excluding null values)
        $totalCompanies = $companies->whereNotNull('company_name')->unique('company_name')->count();

        return view('visitor_management.visitor_company_index', compact('companies', 'totalCompanies'));
    }

    public function create()
    {
        return view('visitor_management.visitor_company_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'purpose' => 'required|string|max:255',
            'visit_date' => 'required|date',
            'date_of_birth' => 'nullable|date',
            'national_id' => 'nullable|string|max:50',
            'gender' => 'nullable|in:Male,Female,Other',
            'visitor_type' => 'required|string|in:group,single',
        ]);

        VisitorCompany::create($request->all());

        return redirect()->route('visitor_company')->with('success', 'Visitor added successfully.');
    }

    public function view($id)
    {
        $companyVisitor = VisitorCompany::findOrFail($id);
        return view('visitor_management.visitor_company_view', compact('companyVisitor'));
    }

    public function edit($id)
    {
        $companyVisitor = VisitorCompany::findOrFail($id);
        return view('visitor_management.visitor_company_edit', compact('companyVisitor'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'company_name' => 'nullable|string|max:255',
            'purpose' => 'required|string|max:255',
            'visitor_type' => 'required|string|in:group,single',
        ]);

        $companyVisitor = VisitorCompany::findOrFail($id);
        $companyVisitor->update($request->all());

        return redirect()->route('visitor_company')->with('success', 'Visitor updated successfully.');
    }



    public function downloadPDF($id)
    {
        $visitor = Visitor::findOrFail($id);

        $pdf = Pdf::loadView('visitor_management.visitor_company_pdf', compact('visitor'));
        return $pdf->download('visitor_details_' . $visitor->id . '.pdf');
    }

    public function downloadWord($id)
    {
        $visitor = Visitor::findOrFail($id);

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add visitor details to the Word document
        $section->addText("Visitor Details");
        $section->addText("Name: " . $visitor->name);
        $section->addText("Phone: " . $visitor->phone);
        $section->addText("Purpose: " . $visitor->purpose);
        $section->addText("Visit Date: " . $visitor->visit_date);
        $section->addText("Date of Birth: " . ($visitor->date_of_birth ?? 'N/A'));
        $section->addText("Age: " . ($visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age : 'N/A'));
        $section->addText("National ID: " . ($visitor->national_id ?? 'N/A'));
        $section->addText("Gender: " . ($visitor->gender ?? 'N/A'));

        // Save the Word document
        $fileName = 'visitor_details_' . $visitor->id . '.docx';
        $filePath = storage_path($fileName);
        $phpWord->save($filePath, 'Word2007');

        // Return the Word document for download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
