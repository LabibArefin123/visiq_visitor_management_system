<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAttendance;
use App\Models\Visitor;
use App\Models\PendingVisitor;
use App\Models\VisitorEmergency;
use App\Models\BlacklistedVisitor;
use Carbon\Carbon;


class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalVisitors = Visitor::count();
        $totalEmployees = Employee::count();
        $totalPendingVisitors = PendingVisitor::count();
        $totalEmergencyVisitors = VisitorEmergency::count();
        $totalBlacklistVisitors = BlacklistedVisitor::count();

        // Get today's date
        $today = \Carbon\Carbon::today();

        // ✅ Check if attendance table has today's date data
        $todayCheckins = EmployeeAttendance::whereDate('check_in_date', $today)->exists();

        if ($todayCheckins) {
            // ✅ Count for today only
            $totalCurrentCheckinEmployees = EmployeeAttendance::whereDate('check_in_date', $today)
                ->whereNotNull('check_in_time')
                ->distinct('employee_id')
                ->count('employee_id');

            $totalCurrentCheckoutEmployees = EmployeeAttendance::whereDate('check_out_date', $today)
                ->whereNotNull('check_out_time')
                ->distinct('employee_id')
                ->count('employee_id');
        } else {
            // ✅ Fallback: show total count from all records
            $totalCurrentCheckinEmployees = EmployeeAttendance::whereNotNull('check_in_time')
                ->distinct('employee_id')
                ->count('employee_id');

            $totalCurrentCheckoutEmployees = EmployeeAttendance::whereNotNull('check_out_time')
                ->distinct('employee_id')
                ->count('employee_id');
        }

        return view('dashboard', compact(
            'totalVisitors',
            'totalEmployees',
            'totalPendingVisitors',
            'totalEmergencyVisitors',
            'totalBlacklistVisitors',
            'totalCurrentCheckinEmployees',
            'totalCurrentCheckoutEmployees'
        ));
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
