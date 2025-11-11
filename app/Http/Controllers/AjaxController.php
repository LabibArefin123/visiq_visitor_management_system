<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Division;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Guard;
use App\Models\BuildingLocation;
use App\Models\ParkingList;
use App\Models\ParkingLocation;
use App\Models\BuildingList;

class AjaxController extends Controller
{
    /**
     * Get all locations under a specific Area.
     */
    public function getLocationsByArea(Request $request)
    {
        $areaId = $request->area_id;

        $locations = BuildingLocation::where('area_id', $areaId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($locations);
    }

    /**
     * Get all building lists under a specific Location.
     */
    public function getBuildingsByLocation(Request $request)
    {
        $locationId = $request->building_location_id;

        $buildings = BuildingList::where('building_location_id', $locationId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($buildings);
    }

    public function getParkingLocationByBuildingName(Request $request)
    {
        $parkingLocationId = $request->building_list_id;

        $parkingLocations = ParkingLocation::where('building_list_id', $parkingLocationId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($parkingLocations);
    }

    public function getParkingByParkingLocationName(Request $request)
    {
        $parkingLocationId = $request->parking_location_id;

        $parkingLists = ParkingList::where('parking_location_id', $parkingLocationId)
            ->whereDoesntHave('allotments', function ($query) {
                $query->where('status', 'occupied');
            })
            ->orderBy('level', 'asc')
            ->orderBy('name', 'asc')
            ->get(['id', 'name', 'level']);

        return response()->json($parkingLists);
    }

    public function getDivisionByBranch(Request $request)
    {
        $branchId = $request->branch_id;

        $divisions = Division::where('branch_id', $branchId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($divisions);
    }

    /**
     * Get departments by division.
     */
    public function getDepartmentByDivision(Request $request)
    {
        $divisionId = $request->division_id;

        $departments = Department::where('division_id', $divisionId)
            ->select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($departments);
    }

    public function getHolders($type)
    {
        switch ($type) {
            case 'employee':
                $data = \App\Models\Employee::orderBy('name', 'asc')
                    ->get(['id', 'name', 'emp_id as unique_code']);
                break;

            case 'guard':
                $data = \App\Models\Guard::orderBy('name', 'asc')
                    ->get(['id', 'name', 'guard_id as unique_code']);
                break;

            default:
                $data = collect();
                break;
        }

        return response()->json($data);
    }

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
