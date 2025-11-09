@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Employees</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Add Employee
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $employee->emp_id ?? 'N/A' }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->department ?? 'N/A' }}</td>
                                <td>{{ $employee->phone ?? 'N/A' }}</td>
                                <td>{{ $employee->email ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employees.show', $employee->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('employees.edit', $employee->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="triggerDeleteModal('{{ route('employees.destroy', $employee->id) }}')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
