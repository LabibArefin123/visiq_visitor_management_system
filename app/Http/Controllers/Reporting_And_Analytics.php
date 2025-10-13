<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\CheckInEmployee;
use App\Models\CheckOutEmployee;
use Illuminate\Support\Carbon;
use App\Models\Visitor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Department;
use App\Models\EmployeeReport;
use App\Models\VisitorAttendance;
use App\Models\VisitorCheckin;
use App\Models\VisitorCheckout;
use App\Models\VisitorReport;

class Reporting_And_Analytics extends Controller
{
    public function visitor_attendance_report()
    {
        $visitors = Visitor::all(); // for dropdown (if needed)
        $visitorReports = collect(); // empty collection initially
        return view('report_and_analytics.visitor_report_index', compact('visitorReports', 'visitors'));
    }


    public function generateVisitorAttendanceReport(Request $request)
    {
        $request->validate([
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'visitor_id'   => 'nullable|exists:visitors,id',
        ]);

        $checkInsQuery = VisitorCheckin::with('visitor')
            ->when($request->start_date, fn($q) => $q->whereDate('check_in_time', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('check_in_time', '<=', $request->end_date))
            ->when($request->visitor_id, fn($q) => $q->where('visitor_id', $request->visitor_id));

        $checkOutsQuery = VisitorCheckout::with('visitor')
            ->when($request->start_date, fn($q) => $q->whereDate('check_out_time', '>=', $request->start_date))
            ->when($request->end_date, fn($q) => $q->whereDate('check_out_time', '<=', $request->end_date))
            ->when($request->visitor_id, fn($q) => $q->where('visitor_id', $request->visitor_id));

        $checkIns = $checkInsQuery->get();
        $checkOuts = $checkOutsQuery->get();

        $visitorReports = Visitor::with(['checkins', 'checkouts'])->get()->filter(function ($visitor) use ($checkIns, $checkOuts) {
            return $checkIns->where('visitor_id', $visitor->id)->count() > 0 || $checkOuts->where('visitor_id', $visitor->id)->count() > 0;
        })->map(function ($visitor) use ($checkIns, $checkOuts) {
            $visitorCheckIns = $checkIns->where('visitor_id', $visitor->id);
            $visitorCheckOuts = $checkOuts->where('visitor_id', $visitor->id);

            return (object)[
                'visitor'         => $visitor,
                'check_in_time'   => optional($visitorCheckIns->sortBy('check_in_time')->first())->check_in_time,
                'check_out_time'  => optional($visitorCheckOuts->sortByDesc('check_out_time')->first())->check_out_time ?? 'N/A',
                'total_checkins'  => $visitorCheckIns->count(),
                'total_checkouts' => $visitorCheckOuts->count(),
                'duration'        => $visitorCheckIns->sum('duration') ?? 0,
            ];
        });


        $visitors = Visitor::all();

        return view('report_and_analytics.visitor_report_index', compact('visitorReports', 'visitors'));
    }


    public function employee_attendance_report()
    {
        $employees = Employee::all();
        return view('report_and_analytics.employee_attendance_report_index', compact('employees'));
    }

    public function generateAttendanceReport(Request $request)
    {
        // Validate the request
        $request->validate([
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'employee_id'  => 'nullable|exists:employees,id',
        ]);

        // Query Check-Ins
        $checkInsQuery = CheckInEmployee::with('employee')
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('check_in_time', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('check_in_time', '<=', $request->end_date);
            })
            ->when($request->employee_id, function ($query) use ($request) {
                return $query->where('employee_id', $request->employee_id);
            });

        // Query Check-Outs
        $checkOutsQuery = CheckOutEmployee::with('employee')
            ->when($request->start_date, function ($query) use ($request) {
                return $query->whereDate('check_out_time', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($query) use ($request) {
                return $query->whereDate('check_out_time', '<=', $request->end_date);
            })
            ->when($request->employee_id, function ($query) use ($request) {
                return $query->where('employee_id', $request->employee_id);
            });

        // Retrieve data
        $checkIns = $checkInsQuery->get();
        $checkOuts = $checkOutsQuery->get();

        // Group Data by Employee
        $attendanceRecords = Employee::with(['checkIns', 'checkOuts'])
            ->get()
            ->map(function ($employee) use ($checkIns, $checkOuts) {
                $employeeCheckIns = $checkIns->where('employee_id', $employee->id);
                $employeeCheckOuts = $checkOuts->where('employee_id', $employee->id);

                return (object) [
                    'employee'        => $employee,
                    'check_in_time'   => optional($employeeCheckIns->sortBy('check_in_time')->first())->check_in_time,
                    'check_out_time'  => optional($employeeCheckOuts->sortByDesc('check_out_time')->first())->check_out_time,
                    'total_checkins'  => $employeeCheckIns->count(),
                    'total_checkouts' => $employeeCheckOuts->count(),
                ];
            });

        // Fetch list of employees for dropdown
        $employees = Employee::all();

        return view('report_and_analytics.employee_attendance_report_index', compact('attendanceRecords', 'employees'));
    }


    public function downloadAttendanceReport(Request $request)
    {
        $request->validate([
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $query = EmployeeReport::with(['employee', 'checkIns', 'checkOuts'])
            ->when($request->start_date, function ($q) use ($request) {
                return $q->whereHas('checkIns', function ($subQ) use ($request) {
                    $subQ->whereDate('check_in_time', '>=', $request->start_date);
                });
            })
            ->when($request->end_date, function ($q) use ($request) {
                return $q->whereHas('checkOuts', function ($subQ) use ($request) {
                    $subQ->whereDate('check_out_time', '<=', $request->end_date);
                });
            })
            ->when($request->employee_id, function ($q) use ($request) {
                return $q->where('employee_id', $request->employee_id);
            });

        $employeeReports = $query->get();

        $attendanceRecords = $employeeReports->map(function ($report) {
            $checkIns = $report->checkIns ?: collect();
            $checkOuts = $report->checkOuts ?: collect();

            $firstCheckIn = $checkIns->sortBy('check_in_time')->first();
            $lastCheckOut = $checkOuts->sortByDesc('check_out_time')->first();

            return (object) [
                'employee'        => $report->employee,
                'check_in_time'   => optional($firstCheckIn)->check_in_time,
                'check_out_time'  => optional($lastCheckOut)->check_out_time,
                'total_checkins'  => $checkIns->count(),
                'total_checkouts' => $checkOuts->count(),
            ];
        });

        $pdf = Pdf::loadView('report_and_analytics.employee_attendance_report', compact('attendanceRecords'));

        return $pdf->download('employee_attendance_report.pdf');
    }


    public function pdf_for_visitor(Request $request)
    {
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'visitor_type' => 'nullable|string|in:Active,Inactive',
        ]);

        $query = Visitor::query();

        if ($request->filled('start_date')) {
            $query->whereDate('check_in_time', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('check_out_time', '<=', $request->end_date);
        }

        if ($request->filled('visitor_type')) {
            $query->where('status', $request->visitor_type);
        }

        $visitors = $query->get();

        $pdf = Pdf::loadView('visitor_management.visitor_report_pdf', compact('visitors', 'validated'));

        return $pdf->download('visitor_report.pdf');
    }

    public function generateVisitorReport(Request $request)
    {
        $visitors = collect(); // empty collection by default
        $totalCheckins = 0;
        $totalCheckouts = 0;

        // Only apply filters if form is submitted with filters
        if ($request->filled('start_date') || $request->filled('end_date')) {

            // Validate input
            $validated = $request->validate([
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
            ]);

            // Build the query with check-in and check-out filters
            $query = VisitorAttendance::with('visitor');

            if ($request->filled('start_date')) {
                $query->where('check_in_time', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->where('check_out_time', '<=', $request->end_date);
            }

            // Only fetch records with both check-in and check-out
            $query->whereNotNull('check_in_time')
                ->whereNotNull('check_out_time');

            $visitors = $query->get();

            $totalCheckins = $visitors->count(); // count records with check-in
            $totalCheckouts = $visitors->filter(fn($v) => $v->check_out_time !== null)->count();
        }

        return view('report_and_analytics.visitor_report_index', compact('visitors', 'totalCheckins', 'totalCheckouts'));
    }

    public function downloadVisitorReport(Request $request)
    {
        // Example logic for retrieving visitor report data
        $visitorReports = VisitorReport::all(); // Or apply necessary filters based on the request
    
        // Check if the data is not empty before returning
        if ($visitorReports->isEmpty()) {
            return redirect()->back()->with('error', 'No visitor reports found.');
        }
    
        return view('report_and_analytics.visitor_report_download', compact('visitorReports'));
    }
    

    public function generateVisitorReportHost(Request $request)
    {
        // Validate and process the request
        $validated = $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Query the visitors based on filters
        $visitors = Visitor::query();

        if ($request->filled('start_date')) {
            $visitors->where('check_in_time', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $visitors->where('check_out_time', '<=', $request->end_date);
        }

        // Fetch visitors after applying the filters and eager load schedules
        $visitors = $visitors->with('schedules')->get();

        // Add host/employee name and count total check-ins and check-outs
        $total_checkins = 0;
        $total_checkouts = 0;

        foreach ($visitors as $visitor) {
            $visitor->employee_name = $visitor->schedules->first()->employee_name ?? 'N/A'; // Fetch the employee name from the schedule

            // Calculate total check-ins and check-outs
            $total_checkins += $visitor->logs()->where('type', 'check_in')->count();
            $total_checkouts += $visitor->logs()->where('type', 'check_out')->count();
        }

        // Pass the filtered visitors, total check-ins, and total check-outs to the view
        return view('report_and_analytics.visitor_report_index', compact('visitors', 'totalCheckins', 'totalCheckouts'));
    }
}
