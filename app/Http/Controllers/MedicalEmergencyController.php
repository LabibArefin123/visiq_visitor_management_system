<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalEmergency;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Guard;

class MedicalEmergencyController extends Controller
{
    public function index()
    {
        $medicalEmergencies = MedicalEmergency::orderBy('incident_time', 'desc')->get();
        return view('security_management.medical_emergency.index', compact('medicalEmergencies'));
    }

    public function create()
    {
        return view('security_management.medical_emergency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'incident_type' => 'required|string|max:255',
            'reported_by_type' => 'required|in:employee,visitor,guard',
            'reported_by_id' => 'required|integer',
            'location' => 'required|string|max:255',
            'incident_time' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Resolved',
        ]);

        MedicalEmergency::create($request->all());

        return redirect()->route('medical_emergencies.index')->with('success', 'Medical Emergency added successfully.');
    }

    public function edit(MedicalEmergency $medicalEmergency)
    {
        return view('security_management.medical_emergency.edit', compact('medicalEmergency'));
    }

    public function show(MedicalEmergency $medicalEmergency)
    {
        return view('security_management.medical_emergency.show', compact('medicalEmergency'));
    }

    public function update(Request $request, MedicalEmergency $medicalEmergency)
    {
        $request->validate([
            'incident_type' => 'required|string|max:255',
            'reported_by_type' => 'required|in:employee,visitor,guard',
            'reported_by_id' => 'required|integer',
            'location' => 'required|string|max:255',
            'incident_time' => 'required|date',
            'status' => 'required|in:Pending,In Progress,Resolved',
        ]);

        $medicalEmergency->update($request->all());

        return redirect()->route('medical_emergencies.index')->with('success', 'Medical Emergency updated successfully.');
    }

    public function destroy(MedicalEmergency $medicalEmergency)
    {
        $medicalEmergency->delete();
        return redirect()->route('medical_emergencies.index')->with('success', 'Medical Emergency deleted successfully.');
    }

    // For dynamic reporter dropdown
    public function getReporters($type)
    {
        switch ($type) {
            case 'employee':
                $data = Employee::orderBy('name')->get(['id', 'name']);
                break;
            case 'visitor':
                $data = Visitor::orderBy('name')->get(['id', 'name']);
                break;
            case 'guard':
                $data = Guard::orderBy('name')->get(['id', 'name']);
                break;
            default:
                $data = collect();
        }
        return response()->json($data);
    }
}
