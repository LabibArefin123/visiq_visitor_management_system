@extends('adminlte::page')

@section('title', 'Meeting Schedule List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Meeting Schedule List</h1>
        <a href="{{ route('meeting_schedules.create') }}" class="btn btn-sm btn-success d-flex align-items-center gap-2">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">

                {{-- Filter Form --}}
                <form method="GET" action="{{ route('meeting_schedules.index') }}" class="row g-2 mb-3">
                    <div class="col-md-3">
                        <select name="month" class="form-select">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="year" class="form-select">
                            @foreach (range(date('Y') - 2, date('Y') + 2) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>

                    <div class="col-md-3 text-end">
                        {{-- View Toggle Button --}}
                        <button type="button" id="toggleView" class="btn btn-secondary w-100">
                            <i class="fas fa-list"></i> Switch to List View
                        </button>
                    </div>
                </form>

                {{-- Calendar View --}}
                <div id="calendarView" class="p-3">
                    <h5 class="fw-bold mb-3">
                        {{ \Carbon\Carbon::create($year, $month)->format('F Y') }}
                    </h5>

                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1);
                                    $daysInMonth = $firstDayOfMonth->daysInMonth;
                                    $startDay = $firstDayOfMonth->dayOfWeek;
                                    $day = 1;
                                @endphp

                                @for ($row = 0; $row < 6; $row++)
                                    <tr>
                                        @for ($col = 0; $col < 7; $col++)
                                            @if ($row === 0 && $col < $startDay)
                                                <td class="bg-light"></td>
                                            @elseif ($day > $daysInMonth)
                                                <td class="bg-light"></td>
                                            @else
                                                @php
                                                    $currentDate = \Carbon\Carbon::create($year, $month, $day)->format(
                                                        'Y-m-d',
                                                    );
                                                    $meeting = collect($days)->firstWhere('date', $currentDate);
                                                @endphp

                                                <td class="p-2" style="height:100px; vertical-align: top;">
                                                    <div class="fw-bold">{{ $day }}</div>
                                                    @if ($meeting)
                                                        <div class="mt-1 small">
                                                            <span
                                                                class="badge bg-primary">{{ $meeting['title'] }}</span><br>
                                                            <span class="text-muted">
                                                                {{ $meeting['slot'] ?? '--' }}
                                                            </span><br>
                                                            <span
                                                                class="badge bg-success">{{ ucfirst($meeting['status']) }}</span>
                                                        </div>
                                                    @else
                                                        <div class="text-muted small">No Meeting</div>
                                                    @endif
                                                </td>
                                                @php $day++; @endphp
                                            @endif
                                        @endfor
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- List View (Hidden by default) --}}
                <div id="listView" class="table-responsive d-none">
                    <table class="table table-hover table-striped align-middle" id="dataTables">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Schedule Name</th>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Time Slot</th>
                                <th>Meeting Title</th>
                                <th>Meeting Type</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($days as $index => $day)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $day['schedule_name'] }}</td>
                                    <td class="text-primary fw-bold">{{ $day['day_name'] }}</td>
                                    <td>{{ \Carbon\Carbon::parse($day['date'])->format('d M, Y') }}</td>
                                    <td>{{ $day['slot'] ?? '--' }}</td>
                                    <td>{{ $day['title'] ?? 'N/A' }}</td>
                                    <td>{{ $day['meeting_type'] ?? 'N/A' }}</td>
                                    <td>
                                        @php $status = strtolower($day['status'] ?? 'N/A'); @endphp
                                        <span
                                            class="badge bg-{{ $status == 'active' ? 'success' : ($status == 'cancelled' ? 'danger' : ($status == 'completed' ? 'info' : 'secondary')) }}">
                                            {{ ucfirst($day['status'] ?? 'N/A') }}
                                        </span>
                                    </td>
                                    <td>{{ $day['description'] ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        @if ($day['id'])
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('meeting_schedules.show', $day['id']) }}"
                                                    class="btn btn-info btn-sm">View</a>
                                                <a href="{{ route('meeting_schedules.edit', $day['id']) }}"
                                                    class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('meeting_schedules.destroy', $day['id']) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No data available for this month.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleView');
            const calendarView = document.getElementById('calendarView');
            const listView = document.getElementById('listView');

            toggleBtn.addEventListener('click', () => {
                if (calendarView.classList.contains('d-none')) {
                    // Switch to Calendar
                    calendarView.classList.remove('d-none');
                    listView.classList.add('d-none');
                    toggleBtn.innerHTML = `<i class="fas fa-list"></i> Switch to List View`;
                } else {
                    // Switch to List
                    calendarView.classList.add('d-none');
                    listView.classList.remove('d-none');
                    toggleBtn.innerHTML = `<i class="fas fa-calendar"></i> Switch to Calendar View`;
                }
            });
        });
    </script>
@stop
