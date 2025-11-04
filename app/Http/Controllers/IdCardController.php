<?php

namespace App\Http\Controllers;

use App\Models\IdCard;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Guard;
use Illuminate\Http\Request;

class IdCardController extends Controller
{
    public function index()
    {
        $idCards = IdCard::latest()->paginate(10);
        return view('security_management.id_card.index', compact('idCards'));
    }

    public function create()
    {
        $employees = Employee::all();
        $visitors = Visitor::all();
        $guards = Guard::all();
        return view('security_management.id_card.create', compact('employees', 'visitors', 'guards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|unique:id_cards,card_number',
            'holder_type' => 'required|in:employee,visitor,guard',
            'holder_id' => 'required',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|string',
        ]);

        IdCard::create($request->all());
        return redirect()->route('id_cards.index')->with('success', 'ID Card created successfully.');
    }

    public function show(IdCard $idCard)
    {
        return view('security_management.id_card.show', compact('idCard'));
    }

    public function edit(IdCard $idCard)
    {
        $employees = Employee::all();
        $visitors = Visitor::all();
        $guards = Guard::all();
        return view('security_management.id_card.edit', compact('idCard', 'employees', 'visitors', 'guards'));
    }

    public function update(Request $request, IdCard $idCard)
    {
        $request->validate([
            'card_number' => 'required|unique:id_cards,card_number,' . $idCard->id,
            'holder_type' => 'required|in:employee,visitor,guard',
            'holder_id' => 'required',
            'issue_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|string',
        ]);

        $idCard->update($request->all());
        return redirect()->route('id_cards.index')->with('success', 'ID Card updated successfully.');
    }

    public function destroy(IdCard $idCard)
    {
        $idCard->delete();
        return redirect()->route('id_cards.index')->with('success', 'ID Card deleted successfully.');
    }
}
