<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorGroupMember;
use App\Models\Visitor;
use App\Models\Employee;

class VisitorGroupMemberController extends Controller
{
    /**
     * Display a listing of visitor group members.
     */
    public function index()
    {
        $groups = VisitorGroupMember::paginate(10);
        $visitors = Visitor::all(); // ✅ Add this line
        return view('visitor_management.visitor_group_member.index', compact('groups', 'visitors'));
    }

    /**
     * Show the form for creating a new group.
     */
    public function create()
    {
        $visitors = Visitor::orderBy('purpose')->orderBy('name')->get();
        $employees = Employee::orderBy('name')->get();
        return view('visitor_management.visitor_group_member.create', compact('visitors', 'employees'));
    }

    /**
     * Store a newly created visitor group.
     */
    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:255',
            'visitor_ids' => 'required|array|min:1',
        ]);

        VisitorGroupMember::create([
            'group_name' => $request->group_name,
            'visitor_ids' => $request->visitor_ids,
            'total_group_members' => count($request->visitor_ids),
        ]);

        return redirect()->route('visitor_group_members.index')->with('success', 'Visitor group created successfully.');
    }

    /**
     * Display the specified visitor group.
     */
    public function show($id)
    {
        $group = VisitorGroupMember::findOrFail($id);
        $visitors = Visitor::all(); // ✅ Required for show page
        return view('visitor_management.visitor_group_member.show', compact('group', 'visitors'));
    }

    /**
     * Show the form for editing a visitor group.
     */
    public function edit($id)
    {
        $group = VisitorGroupMember::findOrFail($id);
        $visitors = Visitor::orderBy('purpose')->orderBy('name')->get();
        return view('visitor_management.visitor_group_member.edit', compact('group', 'visitors'));
    }

    /**
     * Update the specified visitor group.
     */
    public function update(Request $request, $id)
    {
        $group = VisitorGroupMember::findOrFail($id);

        $request->validate([
            'group_name' => 'required|string|max:255',
            'visitor_ids' => 'required|array|min:1',
        ]);

        $group->update([
            'group_name' => $request->group_name,
            'visitor_ids' => $request->visitor_ids,
            'total_group_members' => count($request->visitor_ids),
        ]);

        return redirect()->route('visitor_group_members.index')->with('success', 'Visitor group updated successfully.');
    }

    /**
     * Remove the specified visitor group.
     */
    public function destroy($id)
    {
        $group = VisitorGroupMember::findOrFail($id);
        $group->delete();

        return redirect()->route('visitor_group_members.index')->with('success', 'Visitor group deleted successfully.');
    }
}
