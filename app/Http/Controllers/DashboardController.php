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

        $today = Carbon::today();

        // ✅ Check if attendance table has today's date data
        $todayCheckins = EmployeeAttendance::whereDate('check_in_date', $today)->exists();

        if ($todayCheckins) {
            $totalCurrentCheckinEmployees = EmployeeAttendance::whereDate('check_in_date', $today)
                ->whereNotNull('check_in_time')
                ->distinct('employee_id')
                ->count('employee_id');

            $totalCurrentCheckoutEmployees = EmployeeAttendance::whereDate('check_out_date', $today)
                ->whereNotNull('check_out_time')
                ->distinct('employee_id')
                ->count('employee_id');
        } else {
            $totalCurrentCheckinEmployees = EmployeeAttendance::whereNotNull('check_in_time')
                ->distinct('employee_id')
                ->count('employee_id');

            $totalCurrentCheckoutEmployees = EmployeeAttendance::whereNotNull('check_out_time')
                ->distinct('employee_id')
                ->count('employee_id');
        }

        // ✅ Pending visitor notifications (within the last 3 days)
        $notifications = PendingVisitor::whereDate('visit_date', '<=', $today)
            ->orderByDesc('visit_date')
            ->take(10)
            ->get()
            ->map(function ($visitor) {
                return [
                    'title' => 'Pending Visitor Alert',
                    'name' => $visitor->name,
                    'visit_date' => $visitor->visit_date,
                    'phone' => $visitor->phone ?? 'N/A',
                    'purpose' => $visitor->purpose ?? 'Not Specified',
                    'type' => 'pending_visitor',
                ];
            });

        return view('dashboard', compact(
            'totalVisitors',
            'totalEmployees',
            'totalPendingVisitors',
            'totalEmergencyVisitors',
            'totalBlacklistVisitors',
            'totalCurrentCheckinEmployees',
            'totalCurrentCheckoutEmployees',
            'notifications'
        ));
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
