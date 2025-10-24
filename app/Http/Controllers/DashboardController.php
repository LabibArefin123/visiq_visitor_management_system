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

        return view('dashboard', compact('totalVisitors'));
    }
}

/**
 * Log user activity.
 *
 * @param string $action
 * @param array|null $details
 */
