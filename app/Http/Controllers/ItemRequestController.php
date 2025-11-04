<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemRequest;
use App\Models\SupplyList;
use Carbon\Carbon;

class ItemRequestController extends Controller
{
    public function index()
    {
        $itemRequests = ItemRequest::with('supplyList')->latest()->paginate(20);
        return view('facility_menu.inventory_menu.item_request.index', compact('itemRequests'));
    }

    public function create()
    {
        $supplies = SupplyList::all();
        return view('facility_menu.inventory_menu.item_request.create', compact('supplies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supply_list_id' => 'required|exists:supply_lists,id',
            'requester_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'request_type' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string|in:pending,approved,rejected',
            'remarks' => 'nullable|string',
        ]);

        ItemRequest::create($request->all());

        return redirect()->route('item_requests.index')->with('success', 'Item request created successfully.');
    }

    public function show(ItemRequest $itemRequest)
    {
        return view('facility_menu.inventory_menu.item_request.show', compact('itemRequest'));
    }

    public function edit(ItemRequest $itemRequest)
    {
        $supplies = SupplyList::all();
        return view('facility_menu.inventory_menu.item_request.edit', compact('itemRequest', 'supplies'));
    }

    public function update(Request $request, ItemRequest $itemRequest)
    {
        $request->validate([
            'supply_list_id' => 'required|exists:supply_lists,id',
            'requester_name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'request_type' => 'required|string|max:50',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string|in:pending,approved,rejected',
            'remarks' => 'nullable|string',
        ]);

        $itemRequest->update($request->all());

        return redirect()->route('item_requests.index')->with('success', 'Item request updated successfully.');
    }

    public function destroy(ItemRequest $itemRequest)
    {
        $itemRequest->delete();
        return redirect()->route('item_requests.index')->with('success', 'Item request deleted successfully.');
    }
}
