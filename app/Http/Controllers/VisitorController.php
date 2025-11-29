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
        $visitors = Visitor::with('idCard')->orderBy('id', 'asc')->get();
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

    public function approve($id)
    {
        $pendingVisitor = PendingVisitor::findOrFail($id);

        // Create Visitor Log Entry
        Visitor::create($pendingVisitor->toArray());

        // Delete from Pending Visitors
        $pendingVisitor->delete();

        return redirect()->route('visitor_management');
    }
}
