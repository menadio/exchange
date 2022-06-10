<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Report;
use App\Models\DailyReport;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\Reportservice;

class ReportController extends Controller
{
    /**
     * Get reports list
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Reportservice $reportService)
    {
        $period = Carbon::now()->format('Y-m');

        $reports = $reportService->getReports($period);

        return Inertia::render('Report/Index', [
            'reports' => $reports
        ]);
    }

    /**
     * Download reports summary
     */
    public function summary(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $reports = DailyReport::whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();


        $pdf = PDF::loadView('report-summary', compact('reports'));

        return $pdf->download('report-summary.pdf');
    }
}
