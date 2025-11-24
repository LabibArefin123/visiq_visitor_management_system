<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorGroupSchedule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class VisitorCompanyReportController extends Controller
{
    public function dailyIndex(Request $request)
    {
        $date = $request->get('date');
        $visits = collect();

        if ($date) {
            $visits = VisitorGroupSchedule::with(['employee', 'visitorGroup'])
                ->whereDate('meeting_date', $date)
                ->orderBy('meeting_date', 'asc')
                ->get();
        }


        return view('report_menu.company_visitor.daily.index', compact('visits', 'date'));
    }

    /**
     * Generate PDF for the daily report
     */
    public function dailyDownloadPdf(Request $request)
    {
        $date = $request->get('date', Carbon::now()->format('Y-m-d'));

        $visits = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->whereDate('meeting_date', $date)
            ->orderBy('meeting_date', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.company_visitor.daily.pdf', compact('visits', 'date'))
            ->setPaper('a4', 'portrait');

        // Stream PDF (open in browser, not download)
        return $pdf->stream('Visitor_Company_Daily_Report_' . $date . '.pdf');
    }

    public function monthlyIndex(Request $request)
    {
        $month = $request->get('month');
        $visits = collect(); // Empty by default until filter clicked

        if ($month) {
            try {
                $parsedMonth = Carbon::createFromFormat('Y-m', $month);
                $visits = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
                    ->whereYear('meeting_date', $parsedMonth->year)
                    ->whereMonth('meeting_date', $parsedMonth->month)
                    ->orderBy('meeting_date', 'asc')
                    ->get();
            } catch (\Exception $e) {
                // Invalid month format — skip
            }
        }

        return view('report_menu.company_visitor.monthly.index', compact('visits', 'month'));
    }

    /**
     * Generate PDF for monthly report
     */
    public function monthlyDownloadPdf(Request $request)
    {
        $month = $request->get('month');

        if (!$month) {
            return redirect()->route('report.visitor.monthly')->with('error', 'Please select a month first.');
        }

        $parsedMonth = Carbon::createFromFormat('Y-m', $month);

        $visits = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->whereYear('meeting_date', $parsedMonth->year)
            ->whereMonth('meeting_date', $parsedMonth->month)
            ->orderBy('meeting_date', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.company_visitor.monthly.pdf', compact('visits', 'month'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Visitor_Company_Monthly_Report_' . $month . '.pdf');
    }

    public function yearlyIndex(Request $request)
    {
        $year = $request->get('year');
        $visits = collect(); // Empty until filtered

        if ($year) {
            $visits = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
                ->whereYear('meeting_date', $year)
                ->orderBy('meeting_date', 'asc')
                ->get();
        }

        // Year list for dropdown
        $years = VisitorGroupSchedule::selectRaw('YEAR(meeting_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('report_menu.company_visitor.yearly.index', compact('visits', 'year', 'years'));
    }

    /**
     * Generate PDF for yearly report
     */
    public function yearlyDownloadPdf(Request $request)
    {
        $year = $request->get('year');

        if (!$year) {
            return redirect()->route('report.visitor.yearly')->with('error', 'Please select a year first.');
        }

        $visits = VisitorGroupSchedule::with(['visitorGroup', 'employee'])
            ->whereYear('meeting_date', $year)
            ->orderBy('meeting_date', 'asc')
            ->get();

        $pdf = Pdf::loadView('report_menu.company_visitor.yearly.pdf', compact('visits', 'year'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Visitor_Company_Yearly_Report_' . $year . '.pdf');
    }
}
