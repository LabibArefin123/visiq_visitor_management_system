@extends('adminlte::page')

@section('title', 'Welcome to VisiQ Software')

@section('content')
    {{-- @if ($notifications->isNotEmpty())
        @php
            // Group notifications by visitor name + visit date + purpose
            $groupedNotifications = collect($notifications)->groupBy(function ($note) {
                return $note['name'] . '|' . $note['visit_date'] . '|' . $note['purpose'];
            });
        @endphp

        <div id="notification-container" class="position-fixed"
            style="bottom: 1rem; right: 1rem; z-index: 1050; max-width: 400px; width: 100%;">
            @foreach ($groupedNotifications as $key => $group)
                @php
                    $note = $group->first();
                    $count = $group->count();
                @endphp

                <div class="alert alert-light border-start border-primary border-4 shadow-sm alert-dismissible fade show custom-alert mb-3 position-relative"
                    role="alert" style="cursor: pointer; transition: opacity 0.5s ease-in-out;"
                    onclick="window.location.href='{{ route('pending_visitors.index') }}';">

                    <button type="button" class="custom-close-btn"
                        onclick="event.stopPropagation(); this.closest('.custom-alert').style.opacity='0'; setTimeout(() => this.closest('.custom-alert').remove(), 300);"
                        aria-label="Close">&times;</button>

                    <div class="custom-icon">
                        <i class="fas fa-user-clock text-primary fs-4"></i>
                    </div>

                    <div class="pe-4">
                        <strong>{{ $note['title'] }}</strong>
                        @if ($count > 1)
                            <span class="badge bg-danger ms-1">{{ $count }}</span>
                        @endif
                        <br>
                        Visitor: <strong>{{ $note['name'] }}</strong><br>
                        Visit Date: {{ $note['visit_date'] }}<br>
                        Purpose: {{ $note['purpose'] }}<br>
                        <small class="text-muted">Click to view pending visitor list</small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif --}}

    <style>
        .custom-close-btn {
            position: absolute;
            top: 0.3rem;
            right: 0.5rem;
            background: transparent;
            border: none;
            font-size: 1.2rem;
            font-weight: bold;
            color: #999;
            line-height: 1;
            cursor: pointer;
            z-index: 20;
        }

        .custom-close-btn:hover {
            color: #000;
            transform: scale(1.1);
        }

        .custom-alert {
            padding-right: 3rem;
            border-radius: 0.5rem;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        .custom-alert.fade-out {
            opacity: 0;
        }

        .custom-icon {
            position: absolute;
            bottom: 1.8rem;
            right: 0.8rem;
        }
    </style>

    <div class="container py-6">
        <h1 class="text-2xl font-bold">Visitor Management Dashboard</h1>
        <p class="text-gray-600">Welcome to your VisiQ Dashboard. Here is the summary of your visitor data.</p>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-info text-white shadow-sm dashboard-box hover-box ">
                    <div class="inner">
                        <h3>{{ $totalVisitors ?? '00' }}</h3>
                        <p>Total Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('visitors.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-warning text-white shadow-sm dashboard-box hover-box ">
                    <div class="inner">
                        <h3>{{ $totalEmergencyVisitors ?? '00' }}</h3>
                        <p>Total Emergency Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ambulance"></i>
                    </div>
                    <a href="{{ route('visitor_emergencys.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-danger text-white shadow-sm dashboard-box hover-box ">
                    <div class="inner">
                        <h3>{{ $totalBlacklistVisitors ?? '00' }}</h3>
                        <p>Total Blacklist Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-slash"></i>
                    </div>
                    <a href="{{ route('visitor_blacklists.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-indigo text-white shadow-sm dashboard-box hover-box ">
                    <div class="inner">
                        <h3>{{ $totalPendingVisitors ?? '00' }}</h3>
                        <p>Total Pending Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="{{ route('pending_visitors.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const alerts = document.querySelectorAll('.custom-alert');

            alerts.forEach((alert, index) => {
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => alert.remove(), 500); // Remove after fade animation
                }, 5000 + (index * 500)); // stagger slightly for smooth flow
            });
        });
    </script>
@endsection
