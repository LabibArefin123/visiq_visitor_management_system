@extends('adminlte::page')

@section('title', 'Evacuation Plans')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Evacuation Plans List</h3>
        <a href="{{ route('evacuation_plans.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Plan Name</th>
                            <th>Location</th>
                            <th>Scheduled Date & Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($evacuationPlans as $plan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $plan->plan_name }}</td>
                                <td>{{ $plan->location }}</td>
                                <td>{{ $plan->scheduled_date->format('d M, Y') }}
                                    @if ($plan->scheduled_time)
                                        , {{ \Carbon\Carbon::parse($plan->scheduled_time)->format('h:i A') }}
                                    @endif
                                </td>
                                <td>{{ ucfirst(str_replace('_', ' ', $plan->status)) }}</td>
                                <td>
                                    <a href="{{ route('evacuation_plans.show', $plan->id) }}"
                                        class="btn btn-sm btn-info">View</a>
                                    <a href="{{ route('evacuation_plans.edit', $plan->id) }}"
                                        class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('evacuation_plans.destroy', $plan->id) }}" method="POST"
                                        class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No evacuation plans found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
