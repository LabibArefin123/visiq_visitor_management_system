<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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

        $user = Auth::user();

        // ✅ Check role and load appropriate dashboard
        if ($user->hasRole('admin')) {
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
        } elseif ($user->hasRole('receiptionist')) {
            return view('dashboard_receiptionist', compact(
                'totalVisitors',
                'totalEmployees',
                'totalPendingVisitors',
                'totalEmergencyVisitors',
                'totalBlacklistVisitors',
                'totalCurrentCheckinEmployees',
                'totalCurrentCheckoutEmployees',
                'notifications'
            ));
        } elseif ($user->hasRole('it_officer')) {
            return view('dashboard_it_officer', compact(
                'totalVisitors',
                'totalEmployees',
                'totalPendingVisitors',
                'totalEmergencyVisitors',
                'totalBlacklistVisitors',
                'totalCurrentCheckinEmployees',
                'totalCurrentCheckoutEmployees',
                'notifications'
            ));
        } elseif ($user->hasRole('employee')) {
            return view('dashboard_employee', compact(
                'totalVisitors',
                'totalEmployees',
                'totalPendingVisitors',
                'totalEmergencyVisitors',
                'totalBlacklistVisitors',
                'totalCurrentCheckinEmployees',
                'totalCurrentCheckoutEmployees',
                'notifications'
            ));
        } else {
            abort(403, 'Unauthorized access.');
        }
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
