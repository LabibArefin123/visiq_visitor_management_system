<?php

namespace App\Http\Controllers;

use App\Models\Employee;
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

        return view('dashboard', compact('totalVisitors', 'totalEmployees', 'totalPendingVisitors', 'totalEmergencyVisitors', 'totalBlacklistVisitors'));
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
