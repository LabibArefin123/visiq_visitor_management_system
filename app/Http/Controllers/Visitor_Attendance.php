<?php

namespace App\Http\Controllers;

use App\Models\VisitorCheckInAI;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\VisitorCheckin;
use App\Models\VisitorCheckout;

class Visitor_Attendance extends Controller
{
    public function check_in_visitor()
    {
        $checkInVisitors = VisitorCheckin::with('visitor')->get();
        $totalVisitorCheckin = $checkInVisitors->sum('total_checkins');

        return view('visitor_management.check_in_visitor_index', compact('checkInVisitors', 'totalVisitorCheckin'));
    }


    public function check_out_visitor()
    {
        $checkOutVisitors = VisitorCheckout::with('visitor')->get();
        $totalCheckouts = $checkOutVisitors->sum('total_checkouts'); // Sum total_checkouts column

        return view('visitor_management.check_out_visitor_index', compact('checkOutVisitors', 'totalCheckouts'));
    }
}
