@extends('adminlte::page')

@section('title', 'Welcome to VMS Software')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container mx-auto py-6">
        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-4">Visitor Management Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Welcome to VisiQ Dashboard Page.</p>

        <!-- Statistic Boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalVisitors ?? '00' }}</h3>
                        <p>Total Visitors Registered</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('visitors.index') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitors.index') }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalEmergencyVisitors ?? '00' }}</h3>
                        <p>Total Emergency Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('visitor_emergencys.index') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitor_emergencys.index') }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalBlacklistVisitors ?? '00' }}</h3>
                        <p>Total Blacklist Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('visitor_blacklists.index') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitor_blacklists.index') }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalCheckin ?? '00' }}</h3>
                        <p>Visitors Checked In</p>
                    </div>
                    <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    <a href="{{ Route::has('check_in_visitor') ? route('check_in_visitor') : '#' }}"
                        class="small-box-footer more-info"
                        data-url="{{ Route::has('check_in_visitor') ? route('check_in_visitor') : '#' }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_checkouts ?? '00' }}</h3>
                        <p>Visitors Checked Out</p>
                    </div>
                    <div class="icon"><i class="ion ion-person-add"></i></div>
                    <a href="{{ Route::has('visitor_check_out') ? route('visitor_check_out') : '#' }}"
                        class="small-box-footer more-info"
                        data-url="{{ Route::has('visitor_check_out') ? route('visitor_check_out') : '#' }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalEmployees ?? '00' }}</h3>
                        <p>Total Employees</p>
                    </div>
                    <div class="icon"><i class="ion ion-pie-graph"></i></div>
                    <a href="{{ Route::has('employee_management') ? route('employee_management') : '#' }}"
                        class="small-box-footer more-info"
                        data-url="{{ Route::has('employee_management') ? route('employee_management') : '#' }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Repeat same for other boxes -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $pendingVisitors ?? '00' }}</h3>
                        <p>Pending Visitors</p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="{{ Route::has('pending_visitor_management') ? route('pending_visitor_management') : '#' }}"
                        class="small-box-footer more-info"
                        data-url="{{ Route::has('pending_visitor_management') ? route('pending_visitor_management') : '#' }}">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- Continue for Employees Checked In/Out and Companies with the same pattern -->
        </div>
    </div>
@stop
<!-- Centered Navbar -->
