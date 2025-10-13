@extends('adminlte::page')

@section('title', 'User Activity Log')

@section('content')
    <div class="container">
        <h2>User Activity Log</h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>#</th>
                            <th>Action</th>
                            <th>IP Address</th>
                            <th>Wi-Fi Name</th> <!-- New column for Wi-Fi -->
                            <th>Device</th>
                            <th>Details</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                     {{ $log->action }}
                                </td>
                           
                                <td>
                                    {{ $log->ip_address ?? 'N/A' }}
                                </td>
                                <td>
                                   {{ $log->wifi_name ?? 'Unknown' }}
                                </td>
                                <td>
                                     {{ $log->device ?? 'Unknown' }}
                                </td>
                                <td>
                                    @if ($log->details)
                                        @php
                                            $details = json_decode($log->details, true);
                                        @endphp
                                        @if (isset($details['field']) && isset($details['old_value']) && isset($details['new_value']))
                                            <strong>{{ ucfirst($details['field']) }}:</strong> 
                                            {{ $details['old_value'] ?? 'N/A' }} → 
                                            <span class="text-success"><strong>{{ $details['new_value'] ?? 'N/A' }}</strong></span>
                                        @else
                                            <pre class="bg-light p-2">{{ json_encode($details, JSON_PRETTY_PRINT) }}</pre>
                                        @endif
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td> {{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                <!-- Pagination controls -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $logs->links('pagination::bootstrap-4') }}

                </div>
            </div>
            
        </div>
    </div>
@endsection
