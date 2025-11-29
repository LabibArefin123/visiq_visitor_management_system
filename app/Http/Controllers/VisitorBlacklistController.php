<?php

namespace App\Http\Controllers;

use App\Models\BlacklistedVisitor;
use Illuminate\Http\Request;

class VisitorBlacklistController extends Controller
{
    /**
     * Display a listing of blacklisted visitors.
     */
    public function index(Request $request)
    {
        // Optional search filter
        $search = $request->input('search');
        $blacklistedVisitors = BlacklistedVisitor::when($search, function ($query, $search) {
            $query->search($search);
        })
            ->orderBy('id', 'asc')
            ->get();

        return view('visitor_management.visitor_blacklist.index', compact('blacklistedVisitors', 'search'));
    }

    /**
     * Show the form for creating a new blacklisted visitor.
     */
    public function create()
    {
        return view('visitor_management.visitor_blacklist.create');
    }

    /**
     * Store a newly created blacklisted visitor in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'B_id'          => 'required|unique:blacklisted_visitors,B_id',
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'national_id'   => 'nullable|string|max:20',
            'reason'        => 'required|string|max:500',
            'blacklisted_at' => 'required|date',
        ]);

        BlacklistedVisitor::create($request->only([
            'B_id',
            'name',
            'phone',
            'reason',
            'blacklisted_at',
            'national_id',
        ]));

        return redirect()->route('visitor_blacklists.index')->with('success', 'Visitor has been blacklisted successfully.');
    }

    /**
     * Display the specified blacklisted visitor.
     */
    public function show($id)
    {
        $blacklistedVisitor = BlacklistedVisitor::findOrFail($id);
        return view('visitor_management.visitor_blacklist.show', compact('blacklistedVisitor'));
    }

    /**
     * Show the form for editing the specified blacklisted visitor.
     */
    public function edit($id)
    {
        $blacklistedVisitor = BlacklistedVisitor::findOrFail($id);
        return view('visitor_management.visitor_blacklist.edit', compact('blacklistedVisitor'));
    }

    /**
     * Update the specified blacklisted visitor in storage.
     */
    public function update(Request $request, $id)
    {
        $blacklistedVisitor = BlacklistedVisitor::findOrFail($id);

        $request->validate([
            'B_id'          => 'required|unique:blacklisted_visitors,B_id,' . $id,
            'name'          => 'required|string|max:255',
            'phone'         => 'required|string|max:20',
            'national_id'   => 'nullable|string|max:20',
            'reason'        => 'required|string|max:500',
            'blacklisted_at' => 'required|date',
        ]);

        $blacklistedVisitor->update($request->only([
            'B_id',
            'name',
            'phone',
            'reason',
            'blacklisted_at',
            'national_id',
        ]));

        return redirect()->route('visitor_blacklists.index')->with('success', 'Blacklist record updated successfully.');
    }

    /**
     * Remove the specified blacklisted visitor from storage.
     */
    public function destroy($id)
    {
        $blacklistedVisitor = BlacklistedVisitor::findOrFail($id);
        $blacklistedVisitor->delete();

        return redirect()->route('visitor_blacklists.index')->with('success', 'Blacklist record deleted successfully.');
    }
}
