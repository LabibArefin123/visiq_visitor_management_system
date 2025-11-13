@extends('adminlte::page')

@section('title', 'Interview Schedules')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Interview Schedules</h3>
        <a href="{{ route('interview_schedules.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-1">
            <i class="fas fa-plus"></i> Add New
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
                            <th>ID</th>
                            <th>Candidate Name</th>
                            <th>Interviewer</th>
                            <th>Position</th>
                            <th>Status</th>
                            <th>Interview Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interviewSchedules as $schedule)
                            <tr>
                                <td>{{ $schedule->id }}</td>
                                <td>{{ $schedule->candidate->name }}</td>
                                <td>{{ $schedule->employee->name ?? 'N/A' }}</td>
                                <td>{{ $schedule->position }}</td>
                                <td>
                                    <span
                                        class="badge 
                                        {{ $schedule->status == 'completed' ? 'bg-success' : ($schedule->status == 'cancelled' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ ucfirst($schedule->status) }}
                                    </span>
                                </td>
                                <td>{{ $schedule->interview_date ? $schedule->interview_date->format('d M, Y, h:i A') : 'N/A' }}
                                </td>
                                <td>
                                    <a href="{{ route('interview_schedules.show', $schedule->id) }}"
                                        class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('interview_schedules.edit', $schedule->id) }}"
                                        class="btn btn-sm btn-info"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('interview_schedules.destroy', $schedule->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
