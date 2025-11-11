<?php

namespace App\Http\Controllers;

use App\Models\ParkingList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class ParkingListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parkingLists = ParkingList::with(['userCategory', 'area', 'location', 'building'])->get();
        return view('parking_management.parking_list.index', compact('parkingLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        return view('parking_management.parking_list.create', compact('categories', 'areas'));
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
            'parking_location_id' => 'required|exists:parking_locations,id',
            'level' => 'required|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        ParkingList::create($request->all());

        return redirect()->route('parking_lists.index')->with('success', 'Parking list added successfully.');
    }

    public function show(ParkingList $parkingList)
    {
        return view('parking_management.parking_list.show', compact('parkingList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingList $parkingList)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();
        $plocations = ParkingLocation::all();

        return view('parking_management.parking_list.edit', compact('parkingList', 'categories', 'areas', 'locations', 'buildings', 'plocations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParkingList $parkingList)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'level' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $parkingList->update($request->all());

        return redirect()->route('parking_lists.index')->with('success', 'Parking list updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingList $parkingList)
    {
        $parkingList->delete();
        return redirect()->route('parking_lists.index')->with('success', 'Parking list deleted successfully.');
    }
}
