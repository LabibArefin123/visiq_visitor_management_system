<?php

namespace App\Http\Controllers;

use App\Models\CheckInEmployee;
use App\Models\CheckOutEmployee;
use App\Models\Visitor;
use App\Models\Employee;
use App\Models\Role;
use App\Models\UserActivityLog;
use App\Models\PendingVisitor;
use App\Models\User;
use App\Models\VisitorCheckin;
use App\Models\VisitorCheckout;
use App\Models\VisitorCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;


class HomeController extends Controller
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
        // Fetch data from the database
        $totalVisitors = Visitor::count(); // Total visitors registered
        $totalCheckin = VisitorCheckin::sum('total_checkins'); // Sum total_checkins instead of count
        $total_checkouts = VisitorCheckout::sum('total_checkouts'); // Visitors checked out
        $totalEmployees = Employee::count(); // Total employees
        $pendingVisitors = PendingVisitor::count();
        $totalEmployeeCheckIn = CheckInEmployee::sum('total_checkins');
        $totalEmployeeCheckOut = CheckOutEmployee::sum('total_checkouts');
        $totalCompanies = VisitorCompany::count(); // Total companies

        // Pass data to the view
        return view('home', compact('totalVisitors', 'totalCheckin', 'total_checkouts', 'totalEmployees', 'pendingVisitors', 'totalEmployeeCheckIn', 'totalEmployeeCheckOut', 'totalCompanies'));
    }

    public function statistics()
    {
        $labels = [];
        $visitorCheckIns = [];
        $visitorCheckOuts = [];
        $employeeCheckIns = [];
        $employeeCheckOuts = [];
        
        for ($i = 4; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $label = Carbon::now()->subDays($i)->format('D (M d)');
            $labels[] = $label;
        
            $visitorCheckIns[] = \App\Models\VisitorCheckin::whereDate('check_in_time', $date)->count();
            $visitorCheckOuts[] = \App\Models\VisitorCheckout::whereDate('check_out_time', $date)->count();
        
            $employeeCheckIns[] = \App\Models\CheckInEmployee::whereDate('check_in_time', $date)->count();
            $employeeCheckOuts[] = \App\Models\CheckOutEmployee::whereDate('check_out_time', $date)->count();
        }
        
        return view('statistics', compact(
            'labels',
            'visitorCheckIns',
            'visitorCheckOuts',
            'employeeCheckIns',
            'employeeCheckOuts'
        ));
        
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
