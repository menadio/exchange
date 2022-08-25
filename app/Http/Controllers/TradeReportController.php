<?php

namespace App\Http\Controllers;

use App\Services\EndOfDayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class TradeReportController extends Controller
{
    public function __construct(EndOfDayService $endOfDayService)
    {
        $this->endOfDayService = $endOfDayService;
    }

    public function __invoke()
    {
        try {
            $this->endOfDayService->usdReport();

            $this->endOfDayService->gbpReport();

            $this->endOfDayService->eurReport();

            $this->endOfDayService->aedReport();

            $this->endOfDayService->ngnReport();

            return Redirect::route('reports.index');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
