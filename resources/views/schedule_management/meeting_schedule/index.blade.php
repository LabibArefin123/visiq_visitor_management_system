@extends('adminlte::page')

@section('title', 'Meeting Schedule List')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Meeting Schedule List</h1>
        <div class="d-flex gap-2">
            <button type="button" id="toggleView" class="btn btn-secondary">
                <i class="fas fa-list"></i> Switch to List View
            </button>
        </div>
    </div>
@stop

@section('css')
    <style>
        .meeting-link:hover {
            background-color: #ff9900 !important;
            color: #fff;
        }
    </style>
@stop

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                {{-- 🔹 Filter Section --}}
                <form method="GET" action="{{ route('meeting_schedules.index') }}" class="row g-2 align-items-end mb-3">
                    <div class="col-md-3">
                        <label><strong>Filter By Weekend Schedule</strong></label>
                        <select name="weekend_schedule_id" class="form-select">
                            <option value="">Select Schedule</option>
                            @foreach ($weekendSchedules as $schedule)
                                <option value="{{ $schedule->id }}"
                                    {{ $selectedWeekendId == $schedule->id ? 'selected' : '' }}>
                                    {{ $schedule->title ?? 'Schedule #' . $schedule->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label><strong>Filter By Month</strong></label>
                        <select name="month" class="form-select">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label><strong>Filter By Year</strong></label>
                        <select name="year" class="form-select">
                            @foreach (range(date('Y') - 2, date('Y') + 2) as $y)
                                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                </form>

                {{-- 🔹 Calendar View --}}
                <div id="calendarView" class="p-3">
                    <h5 class="fw-bold mb-3">{{ \Carbon\Carbon::create($year, $month)->format('F Y') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-dark">
                                <tr>
                                    @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $dayName)
                                        <th>{{ $dayName }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $daysInMonth = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
                                    $firstDayOfMonth = \Carbon\Carbon::create($year, $month, 1)->format('l');
                                    $startIndex = array_search($firstDayOfMonth, [
                                        'Sunday',
                                        'Monday',
                                        'Tuesday',
                                        'Wednesday',
                                        'Thursday',
                                        'Friday',
                                        'Saturday',
                                    ]);
                                    $calendar = [];
                                    $dayCounter = 1;

                                    while ($dayCounter <= $daysInMonth) {
                                        $week = array_fill(0, 7, null);
                                        for (
                                            $i = $calendar ? 0 : $startIndex;
                                            $i < 7 && $dayCounter <= $daysInMonth;
                                            $i++
                                        ) {
                                            $week[$i] = $dayCounter;
                                            $dayCounter++;
                                        }
                                        $calendar[] = $week;
                                    }
                                @endphp

                                @foreach ($calendar as $week)
                                    <tr>
                                        @foreach ($week as $dayNumber)
                                            @php
                                                if ($dayNumber) {
                                                    $currentDate = \Carbon\Carbon::create(
                                                        $year,
                                                        $month,
                                                        $dayNumber,
                                                    )->format('Y-m-d');
                                                    $dayMeetings = $days[$currentDate] ?? [];
                                                    $hasMeeting = collect($dayMeetings)
                                                        ->where('status', '!=', 'No Meeting')
                                                        ->isNotEmpty();

                                                    $cellColor = '#f8f9fa';
                                                    if ($hasMeeting) {
                                                        $priority = collect($dayMeetings)
                                                            ->pluck('color')
                                                            ->unique()
                                                            ->toArray();
                                                        if (in_array('red', $priority)) {
                                                            $cellColor = '#ffcccc';
                                                        } elseif (in_array('yellow', $priority)) {
                                                            $cellColor = '#fff3cd';
                                                        } elseif (in_array('green', $priority)) {
                                                            $cellColor = '#d4edda';
                                                        }
                                                    }
                                                }
                                            @endphp

                                            <td class="p-2"
                                                style="height:110px; vertical-align: top; background-color: {{ $dayNumber ? $cellColor : '#f8f9fa' }}">
                                                @if ($dayNumber)
                                                    <div class="fw-bold">{{ $dayNumber }}</div>

                                                    @if ($hasMeeting)
                                                        <div class="mt-1 small text-start">
                                                            {{-- Separate Single and Group --}}
                                                            @foreach (['Single', 'Group'] as $type)
                                                                @php
                                                                    $meetingsOfType = collect($dayMeetings)->where(
                                                                        'meeting_type',
                                                                        $type,
                                                                    );
                                                                @endphp

                                                                @foreach ($meetingsOfType as $meeting)
                                                                    @php
                                                                        $url =
                                                                            $meeting['meeting_type'] === 'Group'
                                                                                ? route(
                                                                                    'visitor_group_schedules.show',
                                                                                    $meeting['id'],
                                                                                )
                                                                                : route(
                                                                                    'visitor_host_schedules.show',
                                                                                    $meeting['id'],
                                                                                );
                                                                    @endphp
                                                                    <a href="{{ $url }}"
                                                                        style="text-decoration: none;">
                                                                        <div class="mb-1 p-1 border rounded bg-white text-dark meeting-link"
                                                                            title="{{ $meeting['title'] }}">
                                                                            <span
                                                                                class="badge
                                                                                @if ($meeting['color'] === 'green') bg-success
                                                                                @elseif ($meeting['color'] === 'yellow') bg-warning
                                                                                @elseif ($meeting['color'] === 'red') bg-danger
                                                                                @else bg-secondary @endif">
                                                                                {{ ucfirst($meeting['status']) }}
                                                                            </span><br>
                                                                            <small class="text-info">
                                                                                {{ $meeting['meeting_type'] === 'Single' ? 'Visitor:' : 'Group:' }}
                                                                                {{ $meeting['visitor_name'] }}
                                                                            </small><br>
                                                                            <small class="text-warning">Employee:
                                                                                {{ $meeting['employee_name'] }}</small>
                                                                        </div>
                                                                    </a>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="text-muted small mt-1">No Meeting</div>
                                                    @endif
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- 🔹 List View --}}
                <div id="listView" class="table-responsive d-none">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Weekend Schedule</th>
                                <th>Day</th>
                                <th>Date</th>
                                <th>Title</th>
                                <th>Visitor / Visitor Group</th>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach ($days as $meetings)
                                @foreach ($meetings as $m)
                                    @if ($m['status'] !== 'No Meeting')
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $m['weekend_schedule'] }}</td>
                                            <td>{{ $m['day_name'] }}</td>
                                            <td>{{ \Carbon\Carbon::parse($m['date'])->format('d M, Y') }}</td>
                                            <td>{{ $m['title'] }}</td>
                                            <td>{{ $m['visitor_name'] }}</td>
                                            <td>{{ $m['employee_name'] }}</td>
                                            <td>
                                                @if ($m['meeting_type'] === 'Group')
                                                    {{ $m['visitor_name'] ?? '--' }} <span
                                                        class="badge bg-primary">Group</span>
                                                @else
                                                    {{ $m['visitor_name'] ?? '--' }} <span
                                                        class="badge bg-info">Single</span>
                                                @endif
                                            </td>

                                            <td><span class="badge bg-success">{{ ucfirst($m['status']) }}</span></td>
                                            <td>{{ $m['description'] }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                            @if (empty($days))
                                <tr>
                                    <td colspan="10" class="text-center">No data available.</td>
                                </tr>
                            @endif
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
                    calendarView.classList.remove('d-none');
                    listView.classList.add('d-none');
                    toggleBtn.innerHTML = `<i class="fas fa-list"></i> Switch to List View`;
                } else {
                    calendarView.classList.add('d-none');
                    listView.classList.remove('d-none');
                    toggleBtn.innerHTML = `<i class="fas fa-calendar"></i> Switch to Calendar View`;
                }
            });
        });
    </script>
@stop
