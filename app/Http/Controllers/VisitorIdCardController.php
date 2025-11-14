<?php

namespace App\Http\Controllers;

use App\Models\VisitorIdCard;
use App\Models\Employee;
use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorIdCardController extends Controller
{
    public function index()
    {
        $visitorIdCards = VisitorIdCard::orderBy('id', 'asc')->get();
        return view('security_management.visitor_id_card.index', compact('visitorIdCards'));
    }

    public function create()
    {
        return view('security_management.visitor_id_card.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'card_number' => 'required|unique:visitor_id_cards,card_number',
            'holder_type' => 'required|in:visitor',
            'holder_id' => 'required',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string|in:active,inactive,expired',
            'remarks' => 'nullable|string',
        ]);

        // If user is admin → use selected status
        // Otherwise → override status to "pending"
        $status = auth()->user()->role === 'admin'
            ? $request->status
            : 'pending';

        VisitorIdCard::create([
            'card_number' => $request->card_number,
            'holder_type' => $request->holder_type,
            'holder_id' => $request->holder_id,
            'issue_date' => $request->issue_date,
            'expiry_date' => $request->expiry_date,
            'status' => $status,
            'remarks' => $request->remarks,
        ]);

        return redirect()
            ->route('visitor_id_cards.index')
            ->with('success', 'Visitor ID Card created successfully.');
    }

    public function show(VisitorIdCard $visitorIdCard)
    {
        return view('security_management.visitor_id_card.show', compact('visitorIdCard'));
    }

    public function edit(VisitorIdCard $visitorIdCard)
    {

        return view('security_management.visitor_id_card.edit', compact('visitorIdCard'));
    }

    public function update(Request $request, VisitorIdCard $visitorIdCard)
    {
        $request->validate([
            'card_number' => 'required|unique:visitor_id_cards,card_number,' . $visitorIdCard->id,
            'holder_type' => 'required|in:visitor',
            'holder_id' => 'required',
            'issue_date' => 'required|date',
            'expiry_date' => 'required|date',
            'status' => 'required|string',
            'remarks' => 'nullable|string',
        ]);

        $visitorIdCard->update($request->all());
        return redirect()->route('visitor_id_cards.index')->with('success', 'Visitor ID Card updated successfully.');
    }

    public function destroy(VisitorIdCard $visitorIdCard)
    {
        $visitorIdCard->delete();
        return redirect()->route('visitor_id_cards.index')->with('success', 'Visitor ID Card deleted successfully.');
    }

    public function approve($id)
    {
        $card = VisitorIdCard::findOrFail($id);

        // Only admin can approve (Spatie roles)
        if (!auth()->user()->hasRole('admin')) {
            return redirect()->back()->with('error', 'Unauthorized action!');
        }

        // Must be pending before approving
        if ($card->status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending cards can be approved.');
        }

        // Approve card
        $card->update([
            'status' => 'active'
        ]);

        return redirect()
            ->route('visitor_id_cards.index')
            ->with('success', 'Visitor ID Card approved successfully.');
    }
}
