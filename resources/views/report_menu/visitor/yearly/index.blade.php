@extends('adminlte::page')

@section('title', 'Visitor Yearly Report')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3>Visitor Yearly Report</h3>
    </div>
@stop

@section('content')
    <div class="card shadow-lg">
        <div class="card-body">
            <form method="GET" action="{{ route('report.visitor.yearly') }}" class="row mb-3">
                <div class="col-md-4">
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

                <div class="col-md-8 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> Filter
                    </button>

                    @if ($year)
                        <a href="{{ route('report.visitor.yearly.pdf', ['year' => $year]) }}" target="_blank"
                            class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @endif
                </div>
            </form>

            <table class="table table-bordered table-striped" id="dataTables">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Visitor Name</th>
                        <th>Employee (Host)</th>
                        <th>Meeting Date</th>
                        <th>Purpose</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($visits as $visit)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $visit->visitor->name ?? 'N/A' }}</td>
                            <td>{{ $visit->employee->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($visit->meeting_date)->format('d M Y, h:i A') }}</td>
                            <td>{{ $visit->purpose }}</td>
                            <td>
                                <span
                                    class="badge 
                                    @if ($visit->status == 'scheduled') bg-info 
                                    @elseif ($visit->status == 'completed') bg-success 
                                    @else bg-danger @endif">
                                    {{ ucfirst($visit->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        @if (!$year)
                            <tr>
                                <td colspan="6" class="text-center text-muted">Please select a year to view data.</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6" class="text-center text-muted">No visitor records found for this year.
                                </td>
                            </tr>
                        @endif
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
