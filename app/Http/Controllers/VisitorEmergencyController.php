<?php

namespace App\Http\Controllers;

use App\Models\VisitorEmergency;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VisitorEmergencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $emergencies = VisitorEmergency::orderBy('id', 'asc')->paginate(25);
        return view('visitor_management.visitor_emergency.index', compact('emergencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitor_management.visitor_emergency.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'emergency_id' => 'required|string|max:255',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'reason'       => 'required|string|max:500',
            'emergency_at' => 'required|date',
        ]);

        $data = $request->all();

        // If emergency_id not given, auto-generate one
        if (empty($data['emergency_id'])) {
            $data['emergency_id'] = 'EMG-' . strtoupper(Str::random(6));
        }

        VisitorEmergency::create($data);

        return redirect()
            ->route('visitor_emergencys.index')
            ->with('success', 'Emergency record created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emergency = VisitorEmergency::findOrFail($id);
        return view('visitor_management.visitor_emergency.show', compact('emergency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emergency = VisitorEmergency::findOrFail($id);
        return view('visitor_management.visitor_emergency.edit', compact('emergency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'reason'       => 'required|string|max:500',
            'emergency_at' => 'required|date',
        ]);

        $emergency = VisitorEmergency::findOrFail($id);
        $emergency->update($request->all());

        return redirect()
            ->route('visitor_emergencys.index')
            ->with('success', 'Emergency record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $emergency = VisitorEmergency::findOrFail($id);
        $emergency->delete();

        return redirect()
            ->route('visitor_emergencys.index')
            ->with('success', 'Emergency record deleted successfully!');
    }
}
