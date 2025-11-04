<?php

namespace App\Http\Controllers;

use App\Models\ItemDamage;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ItemDamageController extends Controller
{
    public function index()
    {
        $damages = ItemDamage::orderBy('damage_date', 'asc')->get();
        return view('facility_menu.inventory_menu.item_damage.index', compact('damages'));
    }

    public function create()
    {
        return view('facility_menu.inventory_menu.item_damage.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_name_in_bangla' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'reported_by' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'damage_date' => 'nullable|date',
        ]);

        ItemDamage::create($request->all());

        return redirect()->route('item_damages.index')->with('success', 'Damaged item added successfully.');
    }

    public function show(ItemDamage $itemDamage)
    {
        return view('facility_menu.inventory_menu.item_damage.show', compact('itemDamage'));
    }

    public function edit(ItemDamage $itemDamage)
    {
        return view('facility_menu.inventory_menu.item_damage.edit', compact('itemDamage'));
    }

    public function update(Request $request, ItemDamage $itemDamage)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_name_in_bangla' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'reported_by' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'damage_date' => 'nullable|date',
        ]);

        $itemDamage->update($request->all());

        return redirect()->route('item_damages.index')->with('success', 'Damaged item updated successfully.');
    }

    public function destroy(ItemDamage $itemDamage)
    {
        $itemDamage->delete();
        return redirect()->route('item_damages.index')->with('success', 'Damaged item deleted successfully.');
    }
}
