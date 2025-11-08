@extends('adminlte::page')

@section('title', 'Access History Logs')

@section('content_header')
    <h1>Access History Logs</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap text-center" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Guard Name</th>
                            <th>Access Point</th>
                            <th>Date</th>
                            <th>Check In Time</th>
                            <th>Check Out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->assignPoint->guard_module->name ?? 'N/A' }}</td>
                                <td>{{ $log->assignPoint->accessPoint->name ?? 'N/A' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($log->log_date)->format('d M, Y') }}
                                    ({{ \Carbon\Carbon::parse($log->log_date)->format('l') }})
                                </td>

                                <td>{{ $log->accessed_at ? \Carbon\Carbon::parse($log->accessed_at)->format('h:i A') : '-' }}
                                </td>
                                <td>{{ $log->left_at ? \Carbon\Carbon::parse($log->left_at)->format('h:i A') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
