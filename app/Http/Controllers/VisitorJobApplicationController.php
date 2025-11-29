<?php

namespace App\Http\Controllers;

use App\Models\VisitorJobApplication;
use Illuminate\Http\Request;

class VisitorJobApplicationController extends Controller
{
    public function index()
    {
        $applications = VisitorJobApplication::latest()->get();
        return view('recruitment_menu.visitor_job_application.index', compact('applications'));
    }

    public function create()
    {
        return view('recruitment_menu.visitor_job_application.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|unique:visitor_job_applications,application_id',
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'position' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'application_date' => 'required|date',
        ]);

        VisitorJobApplication::create($request->all());
        return redirect()->route('visitor_job_applications.index')->with('success', 'Application created successfully.');
    }

    public function show(VisitorJobApplication $visitorJobApplication)
    {
        return view('recruitment_menu.visitor_job_application.show', compact('visitorJobApplication'));
    }

    public function edit(VisitorJobApplication $visitorJobApplication)
    {
        return view('recruitment_menu.visitor_job_application.edit', compact('visitorJobApplication'));
    }

    public function update(Request $request, VisitorJobApplication $visitorJobApplication)
    {
        $request->validate([
            'application_id' => 'required|unique:visitor_job_applications,application_id,' . $visitorJobApplication->id,
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'position' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            'application_date' => 'required|date',
        ]);

        $visitorJobApplication->update($request->all());
        return redirect()->route('visitor_job_applications.index')->with('success', 'Application updated successfully.');
    }

    public function destroy(VisitorJobApplication $visitorJobApplication)
    {
        $visitorJobApplication->delete();
        return redirect()->route('visitor_job_applications.index')->with('success', 'Application deleted successfully.');
    }
}
