<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use Illuminate\Http\Request;

class GuardController extends Controller
{
    /**
     * Display a listing of the guards.
     */
    public function index()
    {
        $guards = Guard::latest()->paginate(10);
        return view('security_management.guard.index', compact('guards'));
    }

    /**
     * Show the form for creating a new guard.
     */
    public function create()
    {
        return view('security_management.guard.create');
    }

    /**
     * Store a newly created guard in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'guard_id' => 'required|unique:guards,guard_id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:guards,email',
            'shift' => 'required|string',
            'assigned_gate' => 'required|string',
            'status' => 'required|string',
        ]);

        Guard::create($request->all());

        return redirect()->route('guards.index')->with('success', 'Guard added successfully!');
    }

    /**
     * Display the specified guard.
     */
    public function show(Guard $guard)
    {
        return view('security_management.guard.show', compact('guard'));
    }

    /**
     * Show the form for editing the specified guard.
     */
    public function edit(Guard $guard)
    {
        return view('security_management.guard.edit', compact('guard'));
    }

    /**
     * Update the specified guard in storage.
     */
    public function update(Request $request, Guard $guard)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:guards,email,' . $guard->id,
            'shift' => 'required|string',
            'assigned_gate' => 'required|string',
            'status' => 'required|string',
        ]);

        $guard->update($request->all());

        return redirect()->route('guards.index')->with('success', 'Guard updated successfully!');
    }

    /**
     * Remove the specified guard from storage.
     */
    public function destroy(Guard $guard)
    {
        $guard->delete();
        return redirect()->route('guards.index')->with('success', 'Guard deleted successfully!');
    }
}
