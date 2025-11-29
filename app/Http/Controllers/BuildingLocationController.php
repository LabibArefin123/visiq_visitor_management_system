<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\UserCategory;
use Illuminate\Http\Request;

class BuildingLocationController extends Controller
{
    public function index()
    {
        $locations = BuildingLocation::with(['area', 'userCategory'])->orderBy('id', 'desc')->get();
        return view('building_menu.building_location.index', compact('locations'));
    }

    public function create()
    {
        $areas = Area::all();
        $categories = UserCategory::all();
        return view('building_menu.building_location.create', compact('areas', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'name_in_bangla' => 'nullable|string|max:255',
        ]);

        BuildingLocation::create($request->all());
        return redirect()->route('building_locations.index')->with('success', 'Building location added successfully.');
    }

    public function edit(BuildingLocation $building_location)
    {
        $areas = Area::all();
        $categories = UserCategory::all();
        return view('building_menu.building_location.edit', compact('building_location', 'areas', 'categories'));
    }

    public function update(Request $request, BuildingLocation $building_location)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'name_in_bangla' => 'nullable|string|max:255',
        ]);

        $building_location->update($request->all());
        return redirect()->route('building_location.index')->with('success', 'Building location updated successfully.');
    }

    public function destroy(BuildingLocation $building_location)
    {
        $building_location->delete();
        return redirect()->route('building_location.index')->with('success', 'Building location deleted successfully.');
    }

    public function show(BuildingLocation $building_location)
    {
        return view('building_menu.building_location.show', compact('building_location'));
    }
}
