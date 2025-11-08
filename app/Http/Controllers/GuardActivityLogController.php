<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuardActivityLog;

class GuardActivityLogController extends Controller
{
    public function index()
    {
        $logs = GuardActivityLog::with('guard_module')->orderBy('log_date', 'asc')->get();
        return view('security_management.guard.activity_log', compact('logs'));
    }
}
