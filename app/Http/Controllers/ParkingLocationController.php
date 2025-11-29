<?php

namespace App\Http\Controllers;

use App\Models\ParkingLocation;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use Illuminate\Http\Request;

class ParkingLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parkingLocations = ParkingLocation::with(['userCategory', 'area', 'location', 'building'])->latest()->get();
        return view('parking_management.parking_location.index', compact('parkingLocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = UserCategory::all();
        $areas = Area::all();

        return view('parking_management.parking_location.create', compact('categories', 'areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'building_location_id' => 'required|exists:building_locations,id',
            'building_list_id' => 'required|exists:building_lists,id',
            'level' => 'required|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        ParkingLocation::create($request->all());

        return redirect()->route('parking_locations.index')->with('success', 'Parking location added successfully.');
    }

    public function show(ParkingLocation $parkingLocation)
    {
        return view('parking_management.parking_location.show', compact('parkingLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingLocation $parkingLocation)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();

        return view('parking_management.parking_location.edit', compact('parkingLocation', 'categories', 'areas', 'locations', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParkingLocation $parkingLocation)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'level' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $parkingLocation->update($request->all());

        return redirect()->route('parking_locations.index')->with('success', 'Parking location updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingLocation $parkingLocation)
    {
        $parkingLocation->delete();
        return redirect()->route('parking_locations.index')->with('success', 'Parking location deleted successfully.');
    }
}
