@extends('adminlte::page')

@section('title', 'Reports and Analytics')

@section('content_header')
    <h1>Reports and Analytics</h1>
@stop

@section('content')
    <div class="container">
        <h3>Visitor and Employee Reports</h3>
        <p>Generate and view detailed reports for visitors and employees.</p>

        <!-- Example Analytics -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Total Visitors</div>
                    <div class="card-body">
                        <h4>1,250</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Active Employees</div>
                    <div class="card-body">
                        <h4>75</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Check-Ins Today</div>
                    <div class="card-body">
                        <h4>150</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
