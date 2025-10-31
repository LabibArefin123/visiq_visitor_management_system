@extends('adminlte::page')

@section('title', 'Guard Activity Logs')

@section('content_header')
    <h1>Guard Activity Logs</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Guard Name</th>
                            <th>Date</th>
                            <th>Check In Time</th>
                            <th>Check Out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->guard_module->name ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->log_date)->format('d M, Y') }}</td>
                                <td>{{ $log->check_in ? \Carbon\Carbon::parse($log->check_in)->format('h:i A') : '-' }}</td>
                                <td>{{ $log->check_out ? \Carbon\Carbon::parse($log->check_out)->format('h:i A') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No activity logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $logs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
