<?php

namespace App\Http\Controllers;

use App\Models\PendingVisitor;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendingVisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function approve($id, Request $request)
    {
        $pendingVisitor = PendingVisitor::findOrFail($id);

        // Update status & remarks in PendingVisitor
        $pendingVisitor->update([
            'status' => 'approved',
            'remarks' => $request->input('remarks') ?? 'Approved by admin',
        ]);

        // Prevent duplicate entries
        $existingVisitor = Visitor::where('visitor_id', $pendingVisitor->visitor_id)->first();
        if (!$existingVisitor) {
            Visitor::create([
                'visitor_id'   => $pendingVisitor->visitor_id,
                'name'         => $pendingVisitor->name,
                'email'        => $pendingVisitor->email,
                'phone'        => $pendingVisitor->phone,
                'purpose'      => $pendingVisitor->purpose,
                'visit_date'   => $pendingVisitor->visit_date,
                'date_of_birth' => $pendingVisitor->date_of_birth,
                'national_id'  => $pendingVisitor->national_id,
                'gender'       => $pendingVisitor->gender,
            ]);
        }

        return redirect()->back()->with('success', 'Visitor approved and added successfully.');
    }

    public function index()
    {
        // Get all visitors that are not approved yet
        $pendingVisitors = PendingVisitor::where('status', '!=', 'approved')
            ->orWhereNull('status')
            ->orderBy('visit_date', 'asc')
            ->get();

        // Get all approved visitors
        $approvedVisitors = PendingVisitor::where('status', 'approved')
            ->orderBy('visit_date', 'desc')
            ->get();

        return view('visitor_management.pending_visitors.index', compact('pendingVisitors', 'approvedVisitors'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitor_management.pending_visitors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visitor_id'  => 'required|string|max:30',
            'national_id'  => 'required|string|max:30',
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'purpose'      => 'required|string|max:255',
            'visit_date'   => 'required|date',
            'date_of_birth' => 'required|date',
        ]);

        PendingVisitor::create([
            'visitor_id'  => $request->national_id,
            'national_id'  => $request->national_id,
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'purpose'      => $request->purpose,
            'visit_date'   => $request->visit_date,
            'date_of_birth' => $request->date_of_birth,
        ]);

        return redirect()->route('pending_visitors.index')->with('success', 'Pending visitor added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $visitor = PendingVisitor::findOrFail($id);
        return view('visitor_management.pending_visitors.show', compact('visitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $visitor = PendingVisitor::findOrFail($id);
        return view('visitor_management.pending_visitors.edit', compact('visitor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'visitor_id'  => 'required|string|max:30',
            'national_id'  => 'required|string|max:30',
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'required|string|max:20',
            'purpose'      => 'required|string|max:255',
            'visit_date'   => 'required|date',
            'date_of_birth' => 'required|date',
        ]);

        $visitor = PendingVisitor::findOrFail($id);
        $visitor->update($request->all());

        return redirect()->route('pending_visitors.index')->with('success', 'Pending visitor updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visitor = PendingVisitor::findOrFail($id);
        $visitor->delete();

        return redirect()->route('pending_visitors.index')->with('success', 'Pending visitor deleted successfully!');
    }
}
