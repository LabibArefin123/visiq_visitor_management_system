@extends('adminlte::page')

@section('title', 'Statistics Overview')

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

<div class="container py-4">
    <h2 class="text-center mb-4">📊 Check-In & Check-Out Statistics</h2>

    <div class="row">
        <!-- Visitor Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">Visitor Activity</h3>
                </div>
                <div class="card-body">
                    <canvas id="visitorChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Employee Chart -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Employee Activity</h3>
                </div>
                <div class="card-body">
                    <canvas id="employeeChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const labels = @json($labels); // e.g., ['Sun (Mar 30)', 'Mon (Apr 1)', ...]

    // Visitor Chart
    const visitorCtx = document.getElementById('visitorChart').getContext('2d');
    const visitorChart = new Chart(visitorCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Check Ins',
                    data: @json($visitorCheckIns),
                    backgroundColor: '#17a2b8',
                    borderColor: '#117a8b',
                    borderWidth: 1
                },
                {
                    label: 'Check Outs',
                    data: @json($visitorCheckOuts),
                    backgroundColor: '#ffc107',
                    borderColor: '#e0a800',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });

    // Employee Chart
    const employeeCtx = document.getElementById('employeeChart').getContext('2d');
    const employeeChart = new Chart(employeeCtx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Check Ins',
                    data: @json($employeeCheckIns),
                    backgroundColor: '#007bff',
                    borderColor: '#0056b3',
                    borderWidth: 1
                },
                {
                    label: 'Check Outs',
                    data: @json($employeeCheckOuts),
                    backgroundColor: '#28a745',
                    borderColor: '#1e7e34',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 }
                }
            }
        }
    });
</script>

@endsection
