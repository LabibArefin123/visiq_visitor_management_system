@extends('adminlte::page')

@section('title', 'Pending Visitors')

@php
    $userRole = Auth::user()->getRoleNames()->first();
@endphp

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Pending Visitor List</h1>
        <a href="{{ route('pending_visitors.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm mb-4">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Visitor ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Purpose</th>
                            <th>Visit Date</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pendingVisitors as $visitor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $visitor->visitor_id }}</td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email ?? 'N/A' }}</td>
                                <td>{{ $visitor->purpose }}</td>
                                <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('d M Y') }}</td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('d F Y') : 'N/A' }}
                                </td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age : 'N/A' }}
                                </td>
                                <td>{{ $visitor->national_id }}</td>
                                <td><span class="badge bg-warning">{{ ucfirst($visitor->status ?? 'Pending') }}</span></td>
                                <td>{{ $visitor->remarks ?? 'Pending approval by admin' }}</td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('pending_visitors.show', $visitor->id) }}"
                                            class="btn btn-info btn-sm">View</a>
                                        <a href="{{ route('pending_visitors.edit', $visitor->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>

                                        <form action="{{ route('pending_visitors.destroy', $visitor->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                        @if (in_array($userRole, ['admin', 'it_officer']))
                                            <form action="{{ route('pending_visitors.approve', $visitor->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center">No pending visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- APPROVED VISITORS TABLE -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Approved Visitors</h5>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Visitor ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Purpose</th>
                            <th>Visit Date</th>
                            <th>Date of Birth</th>
                            <th>Age</th>
                            <th>National ID</th>
                            <th>Status</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($approvedVisitors as $visitor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $visitor->visitor_id }}</td>
                                <td>{{ $visitor->name }}</td>
                                <td>{{ $visitor->phone }}</td>
                                <td>{{ $visitor->email ?? 'N/A' }}</td>
                                <td>{{ $visitor->purpose }}</td>
                                <td>{{ \Carbon\Carbon::parse($visitor->visit_date)->format('d M Y') }}</td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->format('d F Y') : 'N/A' }}
                                </td>
                                <td>{{ $visitor->date_of_birth ? \Carbon\Carbon::parse($visitor->date_of_birth)->age : 'N/A' }}
                                </td>
                                <td>{{ $visitor->national_id }}</td>
                                <td><span class="badge bg-success">Approved</span></td>
                                <td>{{ $visitor->remarks ?? 'Approved by admin' }}</td>
                                <td> <a href="{{ route('pending_visitors.show', $visitor->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('pending_visitors.edit', $visitor->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('pending_visitors.destroy', $visitor->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No approved visitors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
