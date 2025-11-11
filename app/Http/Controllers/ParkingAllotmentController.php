<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ParkingAllotment;
use App\Models\ParkingList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class ParkingAllotmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all occupied parking slots from ParkingAllotment
        $occupiedAllotments = ParkingAllotment::with([
            'userCategory',
            'area',
            'location',
            'building',
            'plist',
            'allottedByEmployee'
        ])
            ->where('status', 'occupied')
            ->get();

        // Get all vacant parking slots from ParkingList that are NOT occupied
        $occupiedListIds = $occupiedAllotments->pluck('parking_list_id')->toArray();

        $vacantParkingLists = ParkingList::with(['area', 'location', 'building'])
            ->whereNotIn('id', $occupiedListIds)
            ->get();

        // Merge both into one collection for display
        $parkingData = collect();

        // Add occupied slots
        foreach ($occupiedAllotments as $item) {
            $parkingData->push([
                'id' => $item->id,
                'category' => $item->userCategory->category_name ?? 'N/A',
                'area' => $item->area->name ?? 'N/A',
                'location' => $item->location->name ?? 'N/A',
                'building' => $item->building->name ?? 'N/A',
                'parking_name' => $item->plist->name ?? 'N/A',
                'level' => $item->plist->level ?? 'N/A',
                'alloted_by' => $item->allottedByEmployee->name ?? '--',
                'start_date' => $item->start_date,
                'end_date' => $item->end_date,
                'status' => 'Occupied',
                'remarks' => $item->remarks ?? '--',
                'source' => 'allotment',
            ]);
        }

        // Add vacant slots
        foreach ($vacantParkingLists as $item) {
            $parkingData->push([
                'id' => $item->id,
                'category' => 'N/A',
                'area' => $item->area->name ?? 'N/A',
                'location' => $item->location->name ?? 'N/A',
                'building' => $item->building->name ?? 'N/A',
                'parking_name' => $item->name ?? 'N/A',
                'level' => $item->level ?? 'N/A',
                'alloted_by' => '--',
                'start_date' => null,
                'end_date' => null,
                'status' => 'Vacant',
                'remarks' => '--',
                'source' => 'list',
            ]);
        }

        return view('parking_management.parking_allotment.index', compact('parkingData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $users = Employee::orderBy('name', 'asc')->get();
        return view('parking_management.parking_allotment.create', compact('categories', 'areas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'building_location_id' => 'required|exists:building_locations,id',
            'building_list_id' => 'required|exists:building_lists,id',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'parking_list_id' => 'required|exists:parking_lists,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'alloted_by' => 'nullable|string',
            'status' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        ParkingAllotment::create($request->all());

        return redirect()->route('parking_allotments.index')->with('success', 'Parking allotment added successfully.');
    }

    public function show(ParkingAllotment $parkingAllotment)
    {
        return view('parking_management.parking_allotment.show', compact('parkingAllotment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingAllotment $parkingAllotment)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $users = Employee::orderBy('name', 'asc')->get();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();
        $plocations = ParkingLocation::all();
        $parkingLists = ParkingList::all();

        return view('parking_management.parking_allotment.edit', compact('parkingAllotment', 'categories', 'areas',  'users', 'locations', 'buildings', 'plocations', 'parkingLists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParkingAllotment $parkingAllotment)
    {
        $request->validate([
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'parking_location_id' => 'required|exists:parking_locations,id',
            'parking_list_id' => 'required|exists:parking_lists,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'nullable|string',
            'remarks' => 'nullable|string',
        ]);

        $parkingAllotment->update($request->all());

        return redirect()->route('parking_allotments.index')->with('success', 'Parking allotment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingAllotment $parkingAllotment)
    {
        $parkingAllotment->delete();
        return redirect()->route('parking_allotments.index')->with('success', 'Parking allotment deleted successfully.');
    }
}
