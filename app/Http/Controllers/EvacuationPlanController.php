<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvacuationPlan;

class EvacuationPlanController extends Controller
{
    public function index()
    {
        $evacuationPlans = EvacuationPlan::orderBy('scheduled_date', 'asc')->get();
        return view('security_management.evacuation_plan.index', compact('evacuationPlans'));
    }

    public function create()
    {
        return view('security_management.evacuation_plan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        EvacuationPlan::create($request->all());

        return redirect()->route('evacuation_plans.index')->with('success', 'Evacuation Plan created successfully.');
    }

    public function show(EvacuationPlan $evacuationPlan)
    {
        return view('security_management.evacuation_plan.show', compact('evacuationPlan'));
    }

    public function edit(EvacuationPlan $evacuationPlan)
    {
        return view('security_management.evacuation_plan.edit', compact('evacuationPlan'));
    }

    public function update(Request $request, EvacuationPlan $evacuationPlan)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'scheduled_date' => 'required|date',
            'scheduled_time' => 'required',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $evacuationPlan->update($request->all());

        return redirect()->route('evacuation_plans.index')->with('success', 'Evacuation Plan updated successfully.');
    }

    public function destroy(EvacuationPlan $evacuationPlan)
    {
        $evacuationPlan->delete();
        return redirect()->route('evacuation_plans.index')->with('success', 'Evacuation Plan deleted successfully.');
    }
}
