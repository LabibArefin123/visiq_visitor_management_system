<?php

namespace App\Http\Controllers;

use App\Models\VisitorProbation;
use Illuminate\Http\Request;

class VisitorProbationController extends Controller
{
    public function index()
    {
        $probations = VisitorProbation::latest()->get();
        return view('visitor_management.visitor_probation.index', compact('probations'));
    }

    public function create()
    {
        return view('visitor_management.visitor_probation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'reason' => 'nullable|string',
            'national_id' => 'nullable|string',
            'probation_start' => 'nullable|date',
            'probation_end' => 'nullable|date',
        ]);

        $count = VisitorProbation::count() + 1;
        $probation_id = 'P-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        VisitorProbation::create([
            'probation_id' => $probation_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'reason' => $request->reason,
            'status' => 'pending',
            'national_id' => $request->national_id,
            'probation_start' => $request->probation_start,
            'probation_end' => $request->probation_end,
        ]);

        return redirect()->route('visitor_probations.index')->with('success', 'Visitor probation added successfully.');
    }

    public function edit(VisitorProbation $visitorProbation)
    {
        return view('visitor_management.visitor_probation.edit', compact('visitorProbation'));
    }

    public function update(Request $request, VisitorProbation $visitorProbation)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'reason' => 'nullable|string',
            'status' => 'required|string',
            'national_id' => 'nullable|string',
            'probation_start' => 'nullable|date',
            'probation_end' => 'nullable|date',
        ]);

        $visitorProbation->update($request->all());
        return redirect()->route('visitor_probations.index')->with('success', 'Visitor probation updated successfully.');
    }

    public function show(VisitorProbation $visitorProbation)
    {
        return view('visitor_management.visitor_probation.show', compact('visitorProbation'));
    }

    public function destroy(VisitorProbation $visitorProbation)
    {
        $visitorProbation->delete();
        return redirect()->route('visitor_probations.index')->with('success', 'Visitor probation deleted successfully.');
    }
}
