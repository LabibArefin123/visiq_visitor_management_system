@extends('adminlte::page')

@section('title', 'Visitor Companies')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Visitor Company List</h1>
        <a href="{{ route('visitor_companies.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bi bi-plus" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Company ID</th>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Country</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($visitorCompanies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $company->company_id }}</td>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->contact_person }}</td>
                                <td>{{ $company->email ?? 'N/A' }}</td>
                                <td>{{ $company->phone ?? 'N/A' }}</td>
                                <td>{{ $company->address ?? 'N/A' }}</td>
                                <td>{{ $company->city ?? 'N/A' }}</td>
                                <td>{{ $company->country ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('visitor_companies.show', $company->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('visitor_companies.edit', $company->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('visitor_companies.destroy', $company->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this company?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No companies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
