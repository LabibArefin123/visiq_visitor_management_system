<?php

namespace App\Http\Controllers;

use App\Models\VisitorCompany;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitorCompanies = VisitorCompany::orderBy('id', 'asc')->get();
        return view('visitor_management.visitor_company.index', compact('visitorCompanies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitor_management.visitor_company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|unique:visitor_companies,company_id',
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        VisitorCompany::create([
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        return redirect()->route('visitor_companies.index')->with('success', 'Company added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitor_company = VisitorCompany::findOrFail($id);
        return view('visitor_management.visitor_company.show', compact('visitor_company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitor_company = VisitorCompany::findOrFail($id);
        return view('visitor_management.visitor_company.edit', compact('visitor_company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_id' => 'required|unique:visitor_companies,company_id,' . $id,
            'company_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $visitorCompany = VisitorCompany::findOrFail($id);

        $visitorCompany->update([
            'company_id' => $request->company_id,
            'company_name' => $request->company_name,
            'contact_person' => $request->contact_person,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        return redirect()->route('visitor_companies.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $visitor_company = VisitorCompany::findOrFail($id);
        $visitor_company->delete();

        return redirect()->route('visitor_companies.index')->with('success', 'Company deleted successfully.');
    }
}
