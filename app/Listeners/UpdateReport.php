<?php

namespace App\Listeners;

use App\Models\Report;
use Carbon\Carbon;
use App\Services\Reportservice;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateReport
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Reportservice $reportservice)
    {
        $this->reportService = $reportservice;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $period = Carbon::parse($event->transaction->created_at)
            ->format('Y-m');
        $currencyId = $event->transaction->currency_id;
        $tradeTypeId = $event->transaction->trade_type_id;

        if ( $currencyId === 1 && $tradeTypeId === 1) {
            $totalPurchasedUsd = $this->reportService->getUsdPurchased($period);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_usd_purchased' => $totalPurchasedUsd,
                    'total_naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        }

        if ( $currencyId === 1 && $tradeTypeId === 2) {
            $totalUsdSold = $this->reportService->getUsdSold($period);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_usd_sold' => $totalUsdSold,
                    'total_naira_sold_value' => $totalNairaSoldValue
                ]);
        }

        if ( $currencyId === 2 && $tradeTypeId === 1) {
            $totalPurchasedGbp = $this->reportService->getGbpPurchased($period);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_gbp_purchased' => $totalPurchasedGbp,
                    'total_naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        }

        if ( $currencyId === 2 && $tradeTypeId === 2) {
            $totalGbpSold = $this->reportService->getGbpSold($period);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_gbp_sold' => $totalGbpSold,
                    'total_naira_sold_value' => $totalNairaSoldValue
                ]);
        }

        if ( $currencyId === 3 && $tradeTypeId === 1) {
            $totalPurchasedEur = $this->reportService->getEurPurchased($period);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_eur_purchased' => $totalPurchasedEur,
                    'total_naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        }

        if ( $currencyId === 3 && $tradeTypeId === 2) {
            $totalEurSold = $this->reportService->getEurSold($period);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_eur_sold' => $totalEurSold,
                    'total_naira_sold_value' => $totalNairaSoldValue
                ]);
        }

        if ( $currencyId === 4 && $tradeTypeId === 1) {
            $totalPurchasedAed = $this->reportService->getAedPurchased($period);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_aed_purchased' => $totalPurchasedAed,
                    'total_naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        }

        if ( $currencyId === 4 && $tradeTypeId === 2) {
            $totalAedSold = $this->reportService->getAedSold($period);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($period);
            
            Report::where('period', $period)
                ->update([
                    'total_aed_sold' => $totalAedSold,
                    'total_naira_sold_value' => $totalNairaSoldValue
                ]);
        }
    }
}
