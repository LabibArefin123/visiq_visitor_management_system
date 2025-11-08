<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('building_menu.area.index', compact('areas'));
    }

    public function create()
    {
        return view('building_menu.area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'nullable|string|max:255',
        ]);

        Area::create($request->all());
        return redirect()->route('areas.index')->with('success', 'Area added successfully!');
    }

    public function show(Area $area)
    {
        return view('building_menu.area.show', compact('area'));
    }

    public function edit(Area $area)
    {
        return view('building_menu.area.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'name_in_bangla' => 'nullable|string|max:255',
        ]);

        $area->update($request->all());
        return redirect()->route('areas.index')->with('success', 'Area updated successfully!');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('areas.index')->with('success', 'Area deleted successfully!');
    }
}
