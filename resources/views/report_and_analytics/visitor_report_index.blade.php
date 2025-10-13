@extends('adminlte::page')

@section('title', 'Visitor Report')

@section('content')
    <div class="container">
        <h2>Visitor Reports</h2>

        <!-- Start Date & End Date Form -->
        <form method="GET" action="{{ route('reporting.analytics.generateVisitorReport') }}" class="mb-4">
            <div class="row">
                <!-- Start Date -->
                <div class="col-md-3">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" id="start_date" name="start_date" class="form-control"
                        value="{{ request('start_date') }}">
                </div>
        
                <!-- End Date -->
                <div class="col-md-3">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" id="end_date" name="end_date" class="form-control"
                        value="{{ request('end_date') }}">
                </div>
        
                <!-- Submit Button and Download Button -->
                <div class="col-md-3 d-flex justify-content-center align-items-center mt-3">
                    <button type="submit" class="btn btn-primary mr-2" style="padding: 5px 10px; font-size: 14px; min-width: 120px;">
                        Generate Report
                    </button>
                
                    <button type="button" class="btn btn-danger" style="padding: 5px 10px; font-size: 14px; min-width: 120px;" 
                            onclick="window.location='{{ route('reporting.analytics.downloadVisitorReport', request()->all()) }}'">
                        Download Report
                    </button>
                </div>
                    
                
                
            </div>
        </form>
        
        <!-- Visitor Reports Table -->
        @if ($visitorReports->isNotEmpty())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Visitor ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Check-In Time</th>
                        <th>Check-Out Time</th>
                        <th>Total Check-Ins</th>
                        <th>Total Check-Outs</th>
                        <th>Duration</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visitorReports as $report)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $report->visitor->v_id ?? 'N/A' }}</td>
                            <td>{{ $report->visitor->name ?? 'N/A' }}</td>
                            <td>{{ $report->visitor->email ?? 'N/A' }}</td>
                            <td>{{ $report->visitor->age ?? 'N/A' }}</td>
                            <td>
                                @php
                                    $checkIn = $report->check_in_time ? \Carbon\Carbon::parse($report->check_in_time) : null;
                                @endphp
                                {{ $checkIn ? $checkIn->format('h:i A') : 'N/A' }}
                            </td>
                            <td>
                                @php
                                    $checkOut = $report->check_out_time !== 'N/A' ? \Carbon\Carbon::parse($report->check_out_time) : null;
                                @endphp
                                {{ $checkOut ? $checkOut->format('h:i A') : 'N/A' }}
                            </td>
                            <td>{{ $report->total_checkins }}</td>
                            <td>{{ $report->total_checkouts }}</td>
                            <td>
                                {{ $report->duration ? floor($report->duration / 60) . ' hrs ' . ($report->duration % 60) . ' min' : '0 min' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No visitor reports available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @elseif(request()->has('start_date') || request()->has('end_date') || request()->has('visitor_id'))
            <div class="alert alert-warning text-center">No visitor reports found for the selected filters.</div>
        @endif
    </div>
@endsection
