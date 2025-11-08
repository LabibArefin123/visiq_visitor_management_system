@extends('adminlte::page')

@section('title', 'Medical Emergencies')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Medical Emergencies</h3>
        <a href="{{ route('medical_emergencies.create') }}" class="btn btn-sm btn-success">
            <i class="fas fa-plus"></i> Add New
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
                            <th>Incident Type</th>
                            <th>Reported By</th>
                            <th>Reporter Type</th>
                            <th>Location</th>
                            <th>Incident Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($medicalEmergencies as $emergency)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $emergency->incident_type }}</td>
                                <td>{{ $emergency->reporter->name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($emergency->reported_by_type) }}</td>
                                <td>{{ $emergency->location }}</td>
                                <td>{{ \Carbon\Carbon::parse($emergency->incident_time)->format('d M, Y, h:i A') }}</td>
                                <td>{{ $emergency->status }}</td>
                                <td>
                                    <a href="{{ route('medical_emergencies.show', $emergency->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('medical_emergencies.edit', $emergency->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('medical_emergencies.destroy', $emergency->id) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No medical emergencies found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
