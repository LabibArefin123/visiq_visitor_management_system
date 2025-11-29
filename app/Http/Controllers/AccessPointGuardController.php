<?php

namespace App\Http\Controllers;

use App\Models\AssignPointGuard;
use App\Models\AccessPoint;
use App\Models\Guard;
use App\Models\ShiftGuardSchedule;
use Illuminate\Http\Request;

class AccessPointGuardController extends Controller
{
    public function index()
    {
        $assignments = AssignPointGuard::with(['accessPoint', 'guard_module'])->get();
        return view('security_management.access_point_guard.index', compact('assignments'));
    }

    public function create()
    {
        $accessPoints = AccessPoint::orderBy('name')->get();
        $guards = Guard::orderBy('name')->get();
        return view('security_management.access_point_guard.create', compact('accessPoints', 'guards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'access_point_id' => 'required|exists:access_points,id',
            'guard_id' => 'required|exists:guards,id',
            'shift_start' => 'required',
            'shift_end' => 'required',
        ]);

        AssignPointGuard::create($request->all());

        return redirect()->route('access_point_guards.index')->with('success', 'Guard assigned to Access Point successfully.');
    }

    public function show(AssignPointGuard $accessPointGuard)
    {
        $accessPointGuard->load(['accessPoint', 'guard_module']);
        return view('security_management.access_point_guard.show', compact('accessPointGuard'));
    }

    public function edit(AssignPointGuard $accessPointGuard)
    {
        $accessPoints = AccessPoint::orderBy('name')->get();
        $guards = Guard::orderBy('name')->get();
        return view('security_management.access_point_guard.edit', compact('accessPointGuard', 'accessPoints', 'guards'));
    }

    public function update(Request $request, AssignPointGuard $accessPointGuard)
    {
        $request->validate([
            'access_point_id' => 'required|exists:access_points,id',
            'guard_id' => 'required|exists:guards,id',
            'shift_start' => 'required|',
            'shift_end' => 'required|',
        ]);

        $accessPointGuard->update($request->all());

        return redirect()->route('access_point_guards.index')->with('success', 'Assignment updated successfully.');
    }

    public function destroy(AssignPointGuard $accessPointGuard)
    {
        $accessPointGuard->delete();
        return redirect()->route('access_point_guards.index')->with('success', 'Assignment deleted successfully.');
    }
}
