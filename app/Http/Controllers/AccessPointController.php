<?php

namespace App\Http\Controllers;

use App\Models\AccessPoint;
use Illuminate\Http\Request;

class AccessPointController extends Controller
{
    public function index()
    {
        $accessPoints = AccessPoint::orderBy('name')->get();
        return view('security_management.access_point.index', compact('accessPoints'));
    }

    public function create()
    {
        return view('security_management.access_point.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        AccessPoint::create($request->all());

        return redirect()->route('access_points.index')->with('success', 'Access Point created successfully.');
    }

    public function show(AccessPoint $accessPoint)
    {
        return view('security_management.access_point.show', compact('accessPoint'));
    }

    public function edit(AccessPoint $accessPoint)
    {
        return view('security_management.access_point.edit', compact('accessPoint'));
    }

    public function update(Request $request, AccessPoint $accessPoint)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $accessPoint->update($request->all());

        return redirect()->route('access_points.index')->with('success', 'Access Point updated successfully.');
    }

    public function destroy(AccessPoint $accessPoint)
    {
        $accessPoint->delete();
        return redirect()->route('access_points.index')->with('success', 'Access Point deleted successfully.');
    }
}
