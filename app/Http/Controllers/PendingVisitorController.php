<?php

namespace App\Http\Controllers;

use App\Models\PendingVisitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendingVisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = PendingVisitor::orderBy('visit_date', 'asc')->paginate(10);

        return view('visitor_management.pending_visitors.index', compact('visitors'));
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
