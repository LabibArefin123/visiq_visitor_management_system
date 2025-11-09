@extends('adminlte::page')

@section('title', 'Guard Activity Logs')

@section('content_header')
    <h1>Guard Activity Logs</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="dataTables">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Guard Name</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Check In Time</th>
                            <th class="text-center">Check Out Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->guard_module->name ?? 'N/A' }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($log->log_date)->format('d M, Y') }}</td>
                                <td class="text-center">
                                    {{ $log->check_in ? \Carbon\Carbon::parse($log->check_in)->format('h:i A') : '-' }}</td>
                                <td class="text-center">
                                    {{ $log->check_out ? \Carbon\Carbon::parse($log->check_out)->format('h:i A') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No activity logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
