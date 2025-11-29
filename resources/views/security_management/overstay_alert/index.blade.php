@extends('adminlte::page')

@section('title', 'Overstay Alerts')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Overstay Alerts</h3>
        <a href="{{ route('overstay_alerts.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
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
                            <th>Visitor Name</th>
                            <th class="text-center">Visit Date</th>
                            <th class="text-center">Expected Checkout Date</th>
                            <th class="text-center">Actual Checkout Date</th>
                            <th>Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alerts as $alert)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $alert->visitor_name }}</td>
                                <td class="text-center">{{ $alert->visit_date->format('d M, Y') }}</td>
                                <td class="text-center">{{ $alert->expected_checkout_date->format('d M, Y') }}</td>
                                <td class="text-center">
                                    {{ $alert->actual_checkout_date ? $alert->actual_checkout_date->format('d M, Y') : 'N/A' }}
                                </td>
                                <td>
                                    <span
                                        class="badge bg-{{ $alert->status == 'Resolved' ? 'success' : 'warning' }}">{{ $alert->status }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('overstay_alerts.show', $alert->id) }}" class="btn btn-sm btn-info"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('overstay_alerts.edit', $alert->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('overstay_alerts.destroy', $alert->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this alert?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No overstay alerts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
