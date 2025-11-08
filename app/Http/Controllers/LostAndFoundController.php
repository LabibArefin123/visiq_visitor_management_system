<?php

namespace App\Http\Controllers;

use App\Models\LostAndFound;
use App\Models\Visitor;
use Illuminate\Http\Request;

class LostAndFoundController extends Controller
{
    public function index()
    {
        $lostAndFounds = LostAndFound::with('visitor')->latest()->get();
        return view('asset_management.lost_and_found.index', compact('lostAndFounds'));
    }

    public function create()
    {
        $visitors = Visitor::select('id', 'name')->orderBy('name')->get();
        return view('asset_management.lost_and_found.create', compact('visitors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'status' => 'required|string',
            'visitor_id' => 'nullable|exists:visitors,id',
            'reported_date' => 'required|date',
        ]);

        LostAndFound::create($request->all());

        return redirect()->route('lost_and_founds.index')
            ->with('success', 'Lost/Found record added successfully.');
    }

    public function show(LostAndFound $lostAndFound)
    {
        return view('asset_management.lost_and_found.show', compact('lostAndFound'));
    }

    public function edit(LostAndFound $lostAndFound)
    {
        $visitors = Visitor::select('id', 'name')->orderBy('name')->get();
        return view('asset_management.lost_and_found.edit', compact('lostAndFound', 'visitors'));
    }

    public function update(Request $request, LostAndFound $lostAndFound)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'status' => 'required|string',
            'reported_date' => 'required|date',
        ]);

        $lostAndFound->update($request->all());

        return redirect()->route('lost_and_founds.index')
            ->with('success', 'Lost/Found record updated successfully.');
    }

    public function destroy(LostAndFound $lostAndFound)
    {
        $lostAndFound->delete();

        return redirect()->route('lost_and_founds.index')
            ->with('success', 'Record deleted successfully.');
    }
}
