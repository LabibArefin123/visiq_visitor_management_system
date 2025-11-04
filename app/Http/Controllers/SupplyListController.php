<?php

namespace App\Http\Controllers;

use App\Models\SupplyList;
use Illuminate\Http\Request;

class SupplyListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplyLists = SupplyList::orderBy('id', 'desc')->paginate(10);
        return view('facility_menu.inventory_menu.supply_list.index', compact('supplyLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facility_menu.inventory_menu.supply_list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:100|unique:supply_lists,item_code',
            'category' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:100',
            'quantity' => 'nullable|integer|min:0',
            'reorder_level' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        SupplyList::create($request->all());

        return redirect()->route('supply_lists.index')
            ->with('success', 'Supply item added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplyList $supplyList)
    {
        return view('facility_menu.inventory_menu.supply_list.edit', compact('supplyList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplyList $supplyList)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_code' => 'required|string|max:100|unique:supply_lists,item_code,' . $supplyList->id,
            'category' => 'nullable|string|max:255',
            'unit' => 'nullable|string|max:100',
            'quantity' => 'nullable|integer|min:0',
            'reorder_level' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        $supplyList->update($request->all());

        return redirect()->route('supply_lists.index')
            ->with('success', 'Supply item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplyList $supplyList)
    {
        $supplyList->delete();

        return redirect()->route('supply_lists.index')
            ->with('success', 'Supply item deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SupplyList $supplyList)
    {
        return view('facility_menu.inventory_menu.supply_list.show', compact('supplyList'));
    }
}
