<?php

namespace App\Http\Controllers;

use App\Models\ParkingPermit;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\ParkingAllotment;
use App\Models\ParkingList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use App\Models\ParkingLocation;
use Illuminate\Http\Request;

class ParkingPermitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all active (issued) parking permits
        $activePermits = ParkingPermit::with([
            'visitor',
            'userCategory',
            'area',
            'location',
            'building',
            'plocation',
            'plist',
            'issuedByEmployee'
        ])
            ->where('status', 'occupied')
            ->get();

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

        // Collect all parking_list_ids that are either occupied or have active permits
        $occupiedListIds = array_unique(array_merge(
            $occupiedAllotments->pluck('parking_list_id')->toArray(),
            $activePermits->pluck('parking_list_id')->toArray()
        ));

        // Get all vacant parking slots (not used anywhere)
        $vacantParkingLists = ParkingList::with(['area', 'location', 'building'])
            ->whereNotIn('id', $occupiedListIds)
            ->get();

        // Merge all data sources into one unified collection
        $parkingData = collect();

        // Active (issued) permits
        foreach ($activePermits as $permit) {
            $parkingData->push([
                'id'            => $permit->id,
                'visitor_name'  => $permit->visitor->name ?? 'N/A',
                'category'      => $permit->userCategory->category_name ?? 'N/A',
                'area'          => $permit->area->name ?? 'N/A',
                'location'      => $permit->location->name ?? 'N/A',
                'building'      => $permit->building->name ?? 'N/A',
                'parking_name'  => $permit->plist->name ?? 'N/A',
                'level'         => $permit->plist->level ?? 'N/A',
                'issued_by'     => $permit->issuedByEmployee->name ?? '--',
                'issue_date'    => \Carbon\Carbon::parse($permit->issue_date)->format('d F Y'),
                'expiry_date'   => \Carbon\Carbon::parse($permit->expiry_date)->format('d F Y'),
                'status'        => ucfirst($permit->status),
                'remarks'       => $permit->remarks ?? '--',
                'source'        => 'permit',
                'row_class'     => '', // Normal row
            ]);
        }

        // Occupied from ParkingAllotment (red rows)
        foreach ($occupiedAllotments as $item) {
            $parkingData->push([
                'id'            => $item->id,
                'visitor_name'  => '--',
                'category'      => $item->userCategory->category_name ?? 'N/A',
                'area'          => $item->area->name ?? 'N/A',
                'location'      => $item->location->name ?? 'N/A',
                'building'      => $item->building->name ?? 'N/A',
                'parking_name'  => $item->plist->name ?? 'N/A',
                'level'         => $item->plist->level ?? 'N/A',
                'issued_by'     => $item->allottedByEmployee->name ?? '--',
                'issue_date'    => \Carbon\Carbon::parse($item->start_date)->format('d F Y'),
                'expiry_date'   => \Carbon\Carbon::parse($item->end_date)->format('d F Y'),
                'status'        => 'Taken',
                'remarks'       => $item->remarks ?? '--',
                'source'        => 'allotment',
                'row_class'     => 'table-danger', // 🔴 highlight row red
            ]);
        }

        // Vacant slots (normal white rows)
        foreach ($vacantParkingLists as $list) {
            $parkingData->push([
                'id'            => $list->id,
                'visitor_name'  => '--',
                'category'      => 'N/A',
                'area'          => $list->area->name ?? 'N/A',
                'location'      => $list->location->name ?? 'N/A',
                'building'      => $list->building->name ?? 'N/A',
                'parking_name'  => $list->name ?? 'N/A',
                'level'         => $list->level ?? 'N/A',
                'issued_by'     => '--',
                'issue_date'    => null,
                'expiry_date'   => null,
                'status'        => 'Vacant',
                'remarks'       => '--',
                'source'        => 'list',
                'row_class'     => '', // Normal
            ]);
        }

        return view('parking_management.parking_permit.index', compact('parkingData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visitors = Visitor::orderBy('name')->get();
        $users = Employee::orderBy('name')->get();
        $categories = UserCategory::orderBy('category_name')->get();
        $areas = Area::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        $locations = BuildingLocation::orderBy('name')->get();
        $buildings = BuildingList::orderBy('name')->get();
        $plocations = ParkingLocation::orderBy('name')->get();
        $parkingLists = ParkingList::orderBy('level', 'asc')
            ->orderBy('name', 'asc')
            ->get();


        return view('parking_management.parking_permit.create', compact(
            'visitors',
            'categories',
            'areas',
            'users',
            'employees',
            'locations',
            'buildings',
            'plocations',
            'parkingLists'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'visitor_id'            => 'required|exists:visitors,id',
            'user_category_id'      => 'required|exists:user_categories,id',
            'area_id'               => 'required|exists:areas,id',
            'building_location_id'  => 'required|exists:building_locations,id',
            'building_list_id'      => 'required|exists:building_lists,id',
            'parking_location_id'   => 'required|exists:parking_locations,id',
            'parking_list_id'       => 'required|exists:parking_lists,id',
            'issued_by'             => 'required|exists:employees,id',
            'issue_date'            => 'required|date',
            'expiry_date'           => 'required|date',
            'status'                => 'required',
            'remarks'               => 'nullable|string|max:255',
        ]);

        ParkingPermit::create($validated);

        return redirect()->route('parking_permits.index')
            ->with('success', 'Parking permit issued successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ParkingPermit $parkingPermit)
    {
        $parkingPermit->load(['visitor', 'userCategory', 'area', 'location', 'building', 'plocation', 'plist', 'issuedByEmployee']);
        return view('parking_management.parking_permit.show', compact('parkingPermit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParkingPermit $parkingPermit)
    {
        $visitors = Visitor::orderBy('name')->get();
        $users = Employee::orderBy('name')->get();
        $categories = UserCategory::orderBy('category_name')->get();
        $areas = Area::orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        $locations = BuildingLocation::orderBy('name')->get();
        $buildings = BuildingList::orderBy('name')->get();
        $plocations = ParkingLocation::orderBy('name')->get();
        $parkingLists = ParkingList::orderBy('name')->get();

        return view('parking_management.parking_permit.edit', compact(
            'parkingPermit',
            'visitors',
            'categories',
            'users',
            'areas',
            'employees',
            'locations',
            'buildings',
            'plocations',
            'parkingLists'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParkingPermit $parkingPermit)
    {
        $validated = $request->validate([
            'visitor_id'            => 'required|exists:visitors,id',
            'user_category_id'      => 'required|exists:user_categories,id',
            'area_id'               => 'required|exists:areas,id',
            'building_location_id'  => 'required|exists:building_locations,id',
            'building_list_id'      => 'required|exists:building_lists,id',
            'parking_location_id'   => 'required|exists:parking_locations,id',
            'parking_list_id'       => 'required|exists:parking_lists,id',
            'issued_by'             => 'required|exists:employees,id',
            'issue_date'            => 'required|date',
            'expiry_date'           => 'required|date',
            'status'                => 'required|string',
            'remarks'               => 'nullable|string|max:255',
        ]);

        $parkingPermit->update($validated);

        return redirect()->route('parking_permits.index')
            ->with('success', 'Parking permit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParkingPermit $parkingPermit)
    {
        $parkingPermit->delete();

        return redirect()->route('parking_permits.index')
            ->with('success', 'Parking permit deleted successfully.');
    }
}
