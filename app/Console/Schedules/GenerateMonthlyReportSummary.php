<?php

namespace App\Console\Schedules;

use Carbon\Carbon;
use App\Models\Report;
use App\Services\ReportService;

class GenerateMonthlyReportSummary
{
    public function __invoke(ReportService $reportService)
    {
        $date = Carbon::now()->toDateString();

        $totalPurchasedUsd = $reportService->getUsdPurchased($date);

        $totalUsdSold = $reportService->getUsdSold($date);

        $totalPurchasedGbp = $reportService->getGbpPurchased($date);

        $totalGbpSold = $reportService->getGbpSold($date);

        $totalPurchasedEur = $reportService->getEurPurchased($date);

        $totalEurSold = $reportService->getEurSold($date);

        $totalPurchasedAed = $reportService->getAedPurchased($date);

        $totalAedSold = $reportService->getAedSold($date);

        $totalNairaPurchasedValue = $reportService->getNairaPurchaseValue($date);

        $totalNairaSoldValue = $reportService->getNairaSoldValue($date);

        Report::create([
            'period' => Carbon::parse($date)->format('Y-m'),
            'total_usd_purchased' => $totalPurchasedUsd,
            'total_usd_sold' => $totalUsdSold,
            'total_gbp_purchased' => $totalPurchasedGbp,
            'total_gbp_sold' => $totalGbpSold,
            'total_eur_purchased' => $totalPurchasedEur,
            'total_eur_sold' => $totalEurSold,
            'total_aed_purchased' => $totalPurchasedAed,
            'total_aed_sold' => $totalAedSold,
            'total_naira_purchase_value' => $totalNairaPurchasedValue,
            'total_naira_sold_value' => $totalNairaSoldValue
        ]);
    }
}
