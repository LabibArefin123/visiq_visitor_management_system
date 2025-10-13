@extends('adminlte::page')
@section('title', 'Welcome to VMS Software') 
@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('content')
    <div class="container mx-auto py-6">
        <!-- Page Title -->
        <h1 class="text-2xl font-bold mb-4">Visitor Management Dashboard</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-6">Welcome to this beautiful admin panel.</p>

        <!-- Statistic Boxes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Visitors Registered -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Visitors Registered</h2>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">1,230</p>
            </div>

            <!-- Visitors Currently In -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Visitors Currently In</h2>
                <p class="text-3xl font-bold text-green-500 mt-2">120</p>
            </div>

            <!-- Visitors Checked Out -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Visitors Checked Out</h2>
                <p class="text-3xl font-bold text-red-500 mt-2">1,110</p>
            </div>

            <!-- Visitors Today -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Visitors Today</h2>
                <p class="text-3xl font-bold text-blue-500 mt-2">45</p>
            </div>

            <!-- Total Employees -->
            <div class="p-6 bg-white dark:bg-gray-800 shadow rounded">
                <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Employees</h2>
                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">250</p>
            </div>
        </div>
    </div>
@stop
@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop