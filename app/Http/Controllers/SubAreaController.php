<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubArea;
use App\Models\Area;

class SubAreaController extends Controller
{
    public function index()
    {
        $subAreas = SubArea::with('area')->orderBy('id', 'asc')->paginate(10);
        return view('building_menu.sub_area.index', compact('subAreas'));
    }

    public function create()
    {
        $areas = Area::all();
        return view('building_menu.sub_area.create', compact('areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'sub_area_name' => 'required|string|max:255',
            'sub_area_name_in_bangla' => 'nullable|string|max:255',
        ]);

        SubArea::create($request->all());

        return redirect()->route('sub_areas.index')->with('success', 'Sub Area added successfully!');
    }

    public function show(SubArea $subArea)
    {
        return view('building_menu.sub_area.show', compact('subArea'));
    }

    public function edit(SubArea $subArea)
    {
        $areas = Area::all();
        return view('building_menu.sub_area.edit', compact('subArea', 'areas'));
    }

    public function update(Request $request, SubArea $subArea)
    {
        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'sub_area_name' => 'required|string|max:255',
            'sub_area_name_in_bangla' => 'nullable|string|max:255',
        ]);

        $subArea->update($request->all());

        return redirect()->route('sub_areas.index')->with('success', 'Sub Area updated successfully!');
    }

    public function destroy(SubArea $subArea)
    {
        $subArea->delete();
        return redirect()->route('sub_areas.index')->with('success', 'Sub Area deleted successfully!');
    }
}
