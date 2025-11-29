<?php

namespace App\Http\Controllers;

use App\Models\BuildingList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use Illuminate\Http\Request;

class BuildingListController extends Controller
{
    public function index()
    {
        $buildingLists = BuildingList::with(['category', 'area', 'location'])->latest()->get();
        return view('building_menu.building_list.index', compact('buildingLists'));
    }

    public function create()
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        return view('building_menu.building_list.create', compact('categories', 'areas', 'locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'required|string|max:255',
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'building_location_id' => 'required|exists:building_locations,id',
            'level' => 'required|integer',
            'unit_per_level' => 'nullable|integer',
            'remarks' => 'required|string',
        ]);

        BuildingList::create($request->all());
        return redirect()->route('building_lists.index')->with('success', 'Building List added successfully!');
    }

    public function edit(BuildingList $buildingList)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        return view('building_menu.building_list.edit', compact('buildingList', 'categories', 'areas', 'locations'));
    }

    public function update(Request $request, BuildingList $buildingList)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'required|string|max:255',
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'building_location_id' => 'required|exists:building_locations,id',
            'level' => 'required|integer',
            'unit_per_level' => 'required|integer',
            'remarks' => 'required|string',
        ]);

        $buildingList->update($request->all());
        return redirect()->route('building_lists.index')->with('success', 'Building List updated successfully!');
    }

    public function show(BuildingList $buildingList)
    {
        return view('building_menu.building_list.show', compact('buildingList'));
    }

    public function destroy(BuildingList $buildingList)
    {
        $buildingList->delete();
        return redirect()->route('building_lists.index')->with('success', 'Building List deleted successfully!');
    }
}
