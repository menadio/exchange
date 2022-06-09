<?php

namespace App\Http\Controllers;

use App\Services\Reportservice;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReportController extends Controller
{
    /**
     * Get reports list
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Reportservice $reportService)
    {
        $reports = $reportService->getReports();

        return Inertia::render('Report/Index', [
            'reports' => $reports
        ]);
    }
}
