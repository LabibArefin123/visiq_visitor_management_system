@extends('adminlte::page')

@section('title', 'Welcome to VMS Software')

@section('content')

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-white justify-content-center mb-4">
            <ul class="navbar-nav">
                <li class="nav-item mx-3">
                    <a class="nav-link {{ request()->is('home') ? 'active font-weight-bold text-primary' : '' }}"
                        href="{{ route('home') }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a class="nav-link {{ request()->is('statistics') ? 'active font-weight-bold text-primary' : '' }}"
                        href="{{route('statistics')}}">
                        <i class="fas fa-chart-bar"></i> Statistics
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container mx-auto py-6">
        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-4">Visitor Management Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Welcome to Visitor Management System(VMS) Dashboard Page.</p>

        <!-- Statistic Boxes -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $totalVisitors }}</h3>
                        <p>Total Visitors Registered</p>
                    </div>
                    <div class="icon"><i class="ion ion-bag"></i></div>
                    <a href="{{ route('visitor_management') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitor_management') }}">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $totalCheckin }}</h3>
                        <p>Visitors Checked In</p>
                    </div>
                    <div class="icon"><i class="ion ion-stats-bars"></i></div>
                    <a href="{{ route('check_in_visitor') }}" class="small-box-footer more-info"
                        data-url="{{ route('check_in_visitor') }}">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $total_checkouts }}</h3>
                        <p>Visitors Checked Out</p>
                    </div>
                    <div class="icon"><i class="ion ion-person-add"></i></div>
                    <a href="{{ route('visitor_check_out') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitor_check_out') }}">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $totalEmployees }}</h3>
                        <p>Total Employees</p>
                    </div>
                    <div class="icon"><i class="ion ion-pie-graph"></i></div>
                    <a href="{{ route('employee_management') }}" class="small-box-footer more-info"
                        data-url="{{ route('employee_management') }}">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>{{ $pendingVisitors }}</h3>
                        <p>Pending Visitors</p>
                    </div>
                    <div class="icon"><i class="ion ion-clock"></i></div>
                    <a href="{{ route('pending_visitor_management') }}" class="small-box-footer more-info"
                        data-url="{{ route('pending_visitor_management') }}">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>{{ $totalEmployeeCheckIn }}</h3>
                        <p>Employees Checked In</p>
                    </div>
                    <div class="icon"><i class="ion ion-checkmark"></i></div>
                    <a href="{{ route('check_in_employee') }}" class="small-box-footer more-info"
                        data-url="{{ route('check_in_employee') }}">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3>{{ $totalEmployeeCheckOut }}</h3>
                        <p>Employees Checked Out</p>
                    </div>
                    <div class="icon"><i class="ion ion-checkmark"></i></div>
                    <a href="{{ route('check_out_employee') }}" class="small-box-footer more-info"
                        data-url="{{ route('check_out_employee') }}">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-gradient-purple">
                    <div class="inner">
                        <h3>{{ $totalCompanies }}</h3>
                        <p>Total Companies</p>
                    </div>
                    <div class="icon"><i class="ion ion-checkmark"></i></div>
                    <a href="{{ route('visitor_company') }}" class="small-box-footer more-info"
                        data-url="{{ route('visitor_company') }}">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
      


    @stop
    <!-- Centered Navbar -->
