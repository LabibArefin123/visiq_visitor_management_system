@extends('adminlte::page')

@section('title', 'Employee Yearly Report')

@section('content_header')
    <h3>Employee Yearly Report</h3>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">

            <!-- Filter form -->
            <form method="GET" action="{{ route('report.employee.yearly') }}" class="row mb-3">
                <div class="col-md-3">
                    <label><strong>Select Year</strong></label>
                    <select name="year" class="form-control">
                        <option value="">-- Select Year --</option>
                        @foreach ($years as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-9 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    @if (!empty($year))
                        <a href="{{ route('report.employee.yearly.pdf', ['year' => $year]) }}" target="_blank"
                            class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @endif
                </div>
            </form>

            <!-- Table -->
            <table class="table table-bordered table-striped" id="dataTables">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th class="text-center">Check-in Date</th>
                        <th class="text-center">Check-in Time</th>
                        <th class="text-center">Check-out Date</th>
                        <th class="text-center">Check-out Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances ?? [] as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $attendance->employee->name ?? 'N/A' }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($attendance->check_in_date)->format('d M Y') }}
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($attendance->check_in_time)->format('h:i A') }}
                            </td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($attendance->check_out_date)->format('d M Y') }}</td>
                            <td class="text-center">
                                {{ \Carbon\Carbon::parse($attendance->check_out_time)->format('h:i A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No records found for this year.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
@stop
