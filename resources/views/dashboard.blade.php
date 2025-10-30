@extends('adminlte::page')

@section('title', 'Welcome to VisiQ Software')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container py-6">
        <h1 class="text-2xl font-bold mb-4">Visitor Management Dashboard</h1>
        <p class="text-gray-600 mb-6">Welcome to your VisiQ Dashboard. Here is the summary of your visitor data.</p>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-info text-white shadow-sm dashboard-box hover-box position-relative">
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
                <div class="small-box bg-warning text-white shadow-sm dashboard-box hover-box position-relative">
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
                <div class="small-box bg-danger text-white shadow-sm dashboard-box hover-box position-relative">
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
                <div class="small-box bg-primary text-white shadow-sm dashboard-box hover-box position-relative">
                    <div class="inner">
                        <h3>{{ $totalEmployees ?? '00' }}</h3>
                        <p>Total Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <a href="{{ route('employees.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-success text-white shadow-sm dashboard-box hover-box position-relative">
                    <div class="inner">
                        <h3>{{ $totalCurrentCheckinEmployees ?? '00' }}</h3>
                        <p>Current Checked In Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sign-in-alt"></i>
                    </div>
                    <a href="{{ route('employees.check_in_employee.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-secondary text-white shadow-sm dashboard-box hover-box position-relative">
                    <div class="inner">
                        <h3>{{ $totalCurrentCheckoutEmployees ?? '00' }}</h3>
                        <p>Current Checked Out Employees</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <a href="{{ route('employees.check_out_employee.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="small-box bg-indigo text-white shadow-sm dashboard-box hover-box position-relative">
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

    <style>
        .dashboard-box {
            transition: all 0.3s ease;
        }

        .dashboard-box:hover {
            transform: scale(1.05);
        }

        .dashboard-box .icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 50px;
            opacity: 0.2;
        }

        .small-box-footer {
            display: block;
            background: rgba(0, 0, 0, 0.05);
            color: white;
            text-decoration: none;
            padding: 5px 0;
            transition: 0.3s;
        }

        .small-box-footer:hover {
            color: #f1f1f1;
            background: rgba(0, 0, 0, 0.15);
        }
    </style>
@stop
