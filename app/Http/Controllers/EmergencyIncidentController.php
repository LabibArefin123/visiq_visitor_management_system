<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmergencyIncident;
use Illuminate\Http\Request;

class EmergencyIncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incidents = EmergencyIncident::latest()->paginate(10);
        return view('security_management.emergency_incident.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::orderBy('name', 'asc')->get(); // Sort A to Z
        return view('security_management.emergency_incident.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'incident_type' => 'required|string|max:255',
            'description' => 'required|string',
            'reported_by' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'incident_time' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        EmergencyIncident::create($validated);

        return redirect()->route('emergency_incidents.index')->with('success', 'Emergency incident reported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(EmergencyIncident $emergency_incident)
    {
        return view('security_management.emergency_incident.show', compact('emergency_incident'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmergencyIncident $emergency_incident)
    {
        $employees = Employee::orderBy('name', 'asc')->get(); // Sort A to Z
        return view('security_management.emergency_incident.edit', compact('emergency_incident', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EmergencyIncident $emergency_incident)
    {
        $validated = $request->validate([
            'incident_type' => 'required|string|max:255',
            'description' => 'required|string',
            'reported_by' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'incident_time' => 'required|date',
            'status' => 'required|string|max:50',
        ]);

        $emergency_incident->update($validated);

        return redirect()->route('emergency_incidents.index')->with('success', 'Emergency incident updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmergencyIncident $emergency_incident)
    {
        $emergency_incident->delete();

        return redirect()->route('emergency_incidents.index')->with('success', 'Emergency incident deleted successfully.');
    }
}
