@extends('adminlte::page')

@section('title', 'Blacklist Monitor')

@section('content_header')
    <h1>Blacklist Monitor</h1>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Visitor ID</th>
                            <th>Visitor Name</th>
                            <th>National ID</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monitors as $monitor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $monitor->visitor->blacklist_id ?? 'N/A' }}</td>
                                <td>{{ $monitor->visitor->name ?? 'N/A' }}</td>
                                <td>{{ $monitor->visitor->national_id ?? '-' }}</td>
                                <td>{{ $monitor->visitor->phone ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($monitor->monitor_date)->format('d M, Y') }}</td>
                                <td>{{ $monitor->checked_in_at ? \Carbon\Carbon::parse($monitor->checked_in_at)->format('h:i A') : '-' }}
                                </td>
                                <td>{{ $monitor->checked_out_at ? \Carbon\Carbon::parse($monitor->checked_out_at)->format('h:i A') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No monitor logs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $monitors->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@stop
