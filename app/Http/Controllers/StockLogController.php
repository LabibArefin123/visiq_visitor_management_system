<?php

namespace App\Http\Controllers;

use App\Models\StockLog;
use App\Models\SupplyList;
use Illuminate\Http\Request;

class StockLogController extends Controller
{
    public function index()
    {
        $logs = StockLog::with('supplyList')->orderBy('log_date', 'asc')->paginate(10);
        return view('facility_menu.inventory_menu.stock_log.index', compact('logs'));
    }

    public function create()
    {
        $supplies = SupplyList::orderBy('item_name')->get();
        return view('facility_menu.inventory_menu.stock_log.create', compact('supplies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supply_list_id' => 'required|exists:supply_lists,id',
            'log_type' => 'required|in:stock_in,stock_out',
            'quantity' => 'required|integer|min:1',
            'recorded_by' => 'required|string|max:255',
            'log_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        StockLog::create($request->all());
        return redirect()->route('stock_logs.index')->with('success', 'Stock log created successfully.');
    }

    public function show(StockLog $stock_log)
    {
        return view('facility_menu.inventory_menu.stock_log.show', compact('stock_log'));
    }

    public function edit(StockLog $stock_log)
    {
        $supplies = SupplyList::orderBy('item_name')->get();
        return view('facility_menu.inventory_menu.stock_log.edit', compact('stock_log', 'supplies'));
    }

    public function update(Request $request, StockLog $stock_log)
    {
        $request->validate([
            'supply_list_id' => 'required|exists:supply_lists,id',
            'log_type' => 'required|in:stock_in,stock_out',
            'quantity' => 'required|integer|min:1',
            'recorded_by' => 'required|string|max:255',
            'log_date' => 'required|date',
            'remarks' => 'nullable|string',
        ]);

        $stock_log->update($request->all());
        return redirect()->route('stock_logs.index')->with('success', 'Stock log updated successfully.');
    }

    public function destroy(StockLog $stock_log)
    {
        $stock_log->delete();
        return redirect()->route('stock_logs.index')->with('success', 'Stock log deleted successfully.');
    }
}
