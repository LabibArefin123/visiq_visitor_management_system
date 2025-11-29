<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OverstayAlert;
use App\Models\Visitor;
use Illuminate\Http\Request;

class OverstayAlertController extends Controller
{
    public function index()
    {
        $alerts = OverstayAlert::with('visitor')->latest()->get();
        return view('security_management.overstay_alert.index', compact('alerts'));
    }

    public function create()
    {
        $visitors = Visitor::all();
        return view('security_management.overstay_alert.create', compact('visitors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visitor_id' => 'required|exists:visitors,id',
            'visit_date' => 'required|date',
            'expected_checkout_date' => 'required|date',
            'actual_checkout_date' => 'required|date',
            'status' => 'required|string',
            'remarks' => 'required|string',
        ]);

        $visitor = Visitor::findOrFail($request->visitor_id);

        OverstayAlert::create([
            'visitor_id' => $visitor->id,
            'visitor_name' => $visitor->name,
            'visit_date' => $visitor->visit_date,
            'expected_checkout_date' => $request->expected_checkout_date,
            'actual_checkout_date' => $request->actual_checkout_date,
            'status' => $request->status,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('overstay_alerts.index')->with('success', 'Overstay alert created successfully.');
    }

    public function show(OverstayAlert $overstayAlert)
    {
        return view('security_management.overstay_alert.show', compact('overstayAlert'));
    }

    public function edit(OverstayAlert $overstayAlert)
    {
        $visitors = Visitor::all();
        return view('security_management.overstay_alert.edit', compact('overstayAlert', 'visitors'));
    }

    public function update(Request $request, OverstayAlert $overstayAlert)
    {
        $request->validate([
            'visit_date' => 'required|date',
            'expected_checkout_date' => 'required|date',
            'actual_checkout_date' => 'nullable|date',
            'status' => 'required',
            'remarks' => 'required',
        ]);

        $overstayAlert->update($request->all());

        return redirect()->route('overstay_alerts.index')->with('success', 'Overstay alert updated successfully.');
    }

    public function destroy(OverstayAlert $overstayAlert)
    {
        $overstayAlert->delete();
        return redirect()->route('overstay_alerts.index')->with('success', 'Overstay alert deleted successfully.');
    }
}
