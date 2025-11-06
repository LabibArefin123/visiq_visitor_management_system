<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class EmployeeReportController extends Controller
{
    // --------------------
    // Daily Report
    // --------------------
    public function dailyIndex(Request $request)
    {
        $date = $request->get('date');
        $attendances = collect();

        if ($date) {
            $attendances = EmployeeAttendance::with('employee')
                ->whereDate('check_in_date', $date)
                ->orderBy('check_in_time', 'asc')
                ->get();
        }

        return view('report_menu.employee.daily.index', compact('attendances', 'date'));
    }

    public function dailyDownloadPdf(Request $request)
    {
        $date = $request->get('date', Carbon::now()->format('Y-m-d'));

        $attendances = EmployeeAttendance::with('employee')
            ->whereDate('check_in_date', $date)
            ->orderBy('check_in_time', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.employee.daily.pdf', compact('attendances', 'date'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Employee_Daily_Report_' . $date . '.pdf');
    }

    // --------------------
    // Monthly Report
    // --------------------
    public function monthlyIndex(Request $request)
    {
        $month = $request->get('month'); // format: YYYY-MM
        $attendances = collect();

        if ($month) {
            [$year, $mon] = explode('-', $month);
            $attendances = EmployeeAttendance::with('employee')
                ->whereYear('check_in_date', $year)
                ->whereMonth('check_in_date', $mon)
                ->orderBy('check_in_date', 'asc')
                ->get();
        }

        return view('report_menu.employee.monthly.index', compact('attendances', 'month'));
    }

    public function monthlyDownloadPdf(Request $request)
    {
        $month = $request->get('month');
        [$year, $mon] = explode('-', $month);

        $attendances = EmployeeAttendance::with('employee')
            ->whereYear('check_in_date', $year)
            ->whereMonth('check_in_date', $mon)
            ->orderBy('check_in_date', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.employee.monthly.pdf', compact('attendances', 'month'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Employee_Monthly_Report_' . $month . '.pdf');
    }

    // --------------------
    // Yearly Report
    // --------------------
    public function yearlyIndex(Request $request)
    {
        $year = $request->get('year');
        $attendances = collect();

        if ($year) {
            $attendances = EmployeeAttendance::with('employee')
                ->whereYear('check_in_date', $year)
                ->orderBy('check_in_date', 'asc')
                ->get();
        }

        $years = EmployeeAttendance::selectRaw('YEAR(check_in_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('report_menu.employee.yearly.index', compact('attendances', 'year', 'years'));
    }

    public function yearlyDownloadPdf(Request $request)
    {
        $year = $request->get('year', now()->year);

        $attendances = EmployeeAttendance::with('employee')
            ->whereYear('check_in_date', $year)
            ->orderBy('check_in_date', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.employee.yearly.pdf', compact('attendances', 'year'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Employee_Yearly_Report_' . $year . '.pdf');
    }
}
