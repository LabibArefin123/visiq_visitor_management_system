<?php

namespace App\Http\Controllers;

use App\Models\SeatAllocation;
use App\Models\UserCategory;
use App\Models\RoomList;
use App\Models\Employee;
use App\Models\Visitor;
use Illuminate\Http\Request;

class SeatAllocationController extends Controller
{
    public function index()
    {
        $allocations = SeatAllocation::with(['userCategory', 'room', 'employee', 'visitor'])
            ->latest()->paginate(10);

        return view('facility_menu.allocation_menu.seat_allocation.index', compact('allocations'));
    }

    public function create()
    {
        $categories = UserCategory::all();
        $rooms = RoomList::all();
        $employees = Employee::orderBy('name', 'asc')->get();
        $visitors = Visitor::orderBy('name', 'asc')->get();

        return view('facility_menu.allocation_menu.seat_allocation.create', compact('categories', 'rooms', 'employees', 'visitors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_category_id' => 'required|exists:user_categories,id',
            'room_list_id' => 'required|exists:room_lists,id',
            'seat_number' => 'required|string|max:50|unique:seat_allocations,seat_number',
            'allocation_date' => 'required|date',
            'employee_id' => 'nullable|exists:employees,id',
            'visitor_id' => 'nullable|exists:visitors,id',
            'remarks' => 'nullable|string',
        ]);

        if (!$request->employee_id && !$request->visitor_id) {
            return back()->withErrors(['employee_id' => 'Please select either an employee or a visitor.'])->withInput();
        }

        SeatAllocation::create([
            'user_category_id' => $request->user_category_id,
            'room_list_id' => $request->room_list_id,
            'seat_number' => $request->seat_number,
            'employee_id' => $request->employee_id,
            'visitor_id' => $request->visitor_id,
            'allocation_date' => $request->allocation_date,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('seat_allocations.index')->with('success', 'Seat allocation added successfully.');
    }

    public function show(SeatAllocation $seatAllocation)
    {
        $seatAllocation->load(['userCategory', 'room', 'employee', 'visitor']);
        return view('facility_menu.allocation_menu.seat_allocation.show', compact('seatAllocation'));
    }

    public function edit(SeatAllocation $seatAllocation)
    {
        $categories = UserCategory::all();
        $rooms = RoomList::all();
        $employees = Employee::orderBy('name', 'asc')->get();
        $visitors = Visitor::orderBy('name', 'asc')->get();

        return view('facility_menu.allocation_menu.seat_allocation.edit', compact('seatAllocation', 'categories', 'rooms', 'employees', 'visitors'));
    }

    public function update(Request $request, SeatAllocation $seatAllocation)
    {
        $request->validate([
            'user_category_id' => 'required|exists:user_categories,id',
            'room_list_id' => 'required|exists:room_lists,id',
            'seat_number' => 'required|string|max:50|unique:seat_allocations,seat_number,' . $seatAllocation->id,
            'allocation_date' => 'required|date',
            'employee_id' => 'nullable|exists:employees,id',
            'visitor_id' => 'nullable|exists:visitors,id',
            'remarks' => 'nullable|string',
        ]);

        if (!$request->employee_id && !$request->visitor_id) {
            return back()->withErrors(['employee_id' => 'Please select either an employee or a visitor.'])->withInput();
        }

        $seatAllocation->update([
            'user_category_id' => $request->user_category_id,
            'room_list_id' => $request->room_list_id,
            'seat_number' => $request->seat_number,
            'employee_id' => $request->employee_id,
            'visitor_id' => $request->visitor_id,
            'allocation_date' => $request->allocation_date,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('seat_allocations.index')->with('success', 'Seat allocation updated successfully.');
    }

    public function destroy(SeatAllocation $seatAllocation)
    {
        $seatAllocation->delete();
        return redirect()->route('seat_allocations.index')->with('success', 'Seat allocation deleted successfully.');
    }
}
