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
        $idCards = IdCard::orderBy('id', 'asc')->get();
        return view('security_management.id_card.index', compact('idCards'));
    }

    public function create()
    {
        $employees = Employee::all();
        $guards = Guard::all();
        return view('security_management.id_card.create', compact('employees', 'guards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|unique:id_cards,card_number',
            'holder_type' => 'required|in:employee,guard',
            'holder_id' => 'required',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
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
        $guards = Guard::all();
        return view('security_management.id_card.edit', compact('idCard', 'employees', 'guards'));
    }

    public function update(Request $request, IdCard $idCard)
    {
        $request->validate([
            'card_number' => 'required|unique:id_cards,card_number,' . $idCard->id,
            'holder_type' => 'required|in:employee,guard',
            'holder_id' => 'required',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
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
