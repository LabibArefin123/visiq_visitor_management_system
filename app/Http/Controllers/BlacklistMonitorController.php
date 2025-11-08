<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlacklistMonitor;

class BlacklistMonitorController extends Controller
{
    public function index()
    {
        $monitors = BlacklistMonitor::with('visitor')->orderBy('monitor_date', 'asc')->get();
        return view('security_management.blacklist_monitor.index', compact('monitors'));
    }
}
