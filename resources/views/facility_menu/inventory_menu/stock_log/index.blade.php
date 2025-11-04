@extends('adminlte::page')

@section('title', 'Stock Logs')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Stock Logs</h3>
        <a href="{{ route('stock_logs.create') }}" class="btn btn-sm btn-success">Add New Stock Log</a>
    </div>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Supply Item</th>
                        <th class="text-center">Log Type</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Recorded By</th>
                        <th class="text-center">Log Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->supplyList->item_name }}</td>
                            <td class="text-center">{{ ucfirst(str_replace('_', ' ', $log->log_type)) }}</td>
                            <td class="text-center">{{ $log->quantity }}</td>
                            <td class="text-center">{{ $log->recorded_by }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($log->log_date)->format('d M, Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('stock_logs.show', $log->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('stock_logs.edit', $log->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('stock_logs.destroy', $log->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No stock logs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-center">
                {{ $logs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@stop
