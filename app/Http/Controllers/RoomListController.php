<?php

namespace App\Http\Controllers;

use App\Models\RoomList;
use App\Models\UserCategory;
use App\Models\Area;
use App\Models\BuildingLocation;
use App\Models\BuildingList;
use Illuminate\Http\Request;

class RoomListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = RoomList::with(['category', 'area', 'location', 'building'])->latest()->get();
        return view('building_menu.room_list.index', compact('rooms'));
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

        return view('building_menu.room_list.create', compact('categories', 'areas', 'locations', 'buildings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'required|exists:user_categories,id',
            'area_id' => 'required|exists:areas,id',
            'building_location_id' => 'required|exists:building_locations,id',
            'building_list_id' => 'required|exists:building_lists,id',
            'level' => 'required|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        RoomList::create($request->all());

        return redirect()->route('room_lists.index')->with('success', 'Room added successfully.');
    }

    public function show(RoomList $roomList)
    {
        return view('building_menu.room_list.show', compact('roomList'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoomList $roomList)
    {
        $categories = UserCategory::all();
        $areas = Area::all();
        $locations = BuildingLocation::all();
        $buildings = BuildingList::all();

        return view('building_menu.room_list.edit', compact('roomList', 'categories', 'areas', 'locations', 'buildings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoomList $roomList)
    {
        $request->validate([
            'room_name' => 'required|string|max:255',
            'room_name_in_bangla' => 'nullable|string|max:255',
            'user_category_id' => 'nullable|exists:user_categories,id',
            'area_id' => 'nullable|exists:areas,id',
            'building_location_id' => 'nullable|exists:building_locations,id',
            'building_list_id' => 'nullable|exists:building_lists,id',
            'level' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
        ]);

        $roomList->update($request->all());

        return redirect()->route('room_lists.index')->with('success', 'Room updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomList $roomList)
    {
        $roomList->delete();
        return redirect()->route('room_lists.index')->with('success', 'Room deleted successfully.');
    }
}
