<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkingList;
use App\Models\Visitor;
use App\Models\Employee;

class ParkingListController extends Controller
{
    public function index()
    {
        $parkingLists = ParkingList::latest()->get();
        return view('parking_management.parking_list.index', compact('parkingLists'));
    }

    public function create()
    {
        $visitors = Visitor::all();
        $employees = Employee::all();
        return view('parking_management.parking_list.create', compact('visitors', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parking_name' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'status' => 'required|string',
            'alloted_by' => 'nullable|string|max:255',
        ]);

        ParkingList::create($request->all());
        return redirect()->route('parking_lists.index')->with('success', 'Parking added successfully!');
    }

    public function show(ParkingList $parkingList)
    {
        return view('parking_management.parking_list.show', compact('parkingList'));
    }

    public function edit(ParkingList $parkingList)
    {
        $visitors = Visitor::all();
        $employees = Employee::all();
        return view('parking_management.parking_list.edit', compact('parkingList', 'visitors', 'employees'));
    }

    public function update(Request $request, ParkingList $parkingList)
    {
        $request->validate([
            'parking_name' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'status' => 'required|string',
            'alloted_by' => 'nullable|string|max:255',
        ]);

        $parkingList->update($request->all());
        return redirect()->route('parking_lists.index')->with('success', 'Parking updated successfully!');
    }

    public function destroy(ParkingList $parkingList)
    {
        $parkingList->delete();
        return redirect()->route('parking_lists.index')->with('success', 'Parking deleted successfully!');
    }
}
