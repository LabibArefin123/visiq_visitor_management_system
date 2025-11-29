<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccessHistoryLog;

class AccessHistoryLogController extends Controller
{
    public function index()
    {
        $logs = AccessHistoryLog::with('assignPoint.guard_module', 'assignPoint.accessPoint')
            ->orderBy('log_date', 'asc')
            ->paginate(15);

        return view('security_management.access_point_guard.activity_log', compact('logs'));
    }
}
