@extends('adminlte::page')

@section('title', 'Visitor Job Applications')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Visitor Job Applications</h3>
        <a href="{{ route('visitor_job_applications.create') }}"
            class="btn btn-sm btn-success d-flex align-items-center gap-1">
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
                            <th>ID</th>
                            <th>Application ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Application Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $app)
                            <tr>
                                <td>{{ $app->id }}</td>
                                <td>{{ $app->application_id }}</td>
                                <td>{{ $app->name }}</td>
                                <td>{{ $app->phone }}</td>
                                <td>{{ $app->position }}</td>
                                <td>
                                    <span
                                        class="badge 
                            {{ $app->status == 'approved' ? 'bg-success' : ($app->status == 'rejected' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($app->application_date)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('visitor_job_applications.show', $app->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('visitor_job_applications.edit', $app->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('visitor_job_applications.destroy', $app->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
