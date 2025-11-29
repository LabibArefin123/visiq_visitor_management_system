<?php

namespace App\Http\Controllers;

use App\Models\FlatList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use Illuminate\Http\Request;

class FlatListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flats = FlatList::with(['category', 'area', 'location', 'building'])->latest()->paginate(10);
        return view('building_menu.flat_list.index', compact('flats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();

        return view('building_menu.flat_list.create', compact('categories', 'areas', 'locations', 'buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'flat_name' => 'required|string|max:255',
            'flat_name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'level' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        FlatList::create($request->all());

        return redirect()->route('flat_lists.index')->with('success', 'Flat added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FlatList $flatList)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();

        return view('building_menu.flat_list.edit', compact('flatList', 'categories', 'areas', 'locations', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FlatList $flatList)
    {
        $request->validate([
            'flat_name' => 'required|string|max:255',
            'flat_name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'level' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $flatList->update($request->all());

        return redirect()->route('flat_lists.index')->with('success', 'Flat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FlatList $flatList)
    {
        $flatList->delete();
        return redirect()->route('flat_lists.index')->with('success', 'Flat deleted successfully.');
    }
}
