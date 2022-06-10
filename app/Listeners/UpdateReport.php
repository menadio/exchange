<?php

namespace App\Listeners;

use App\Models\DailyReport;
use App\Models\Report;
use App\Services\CurrencyService;
use Carbon\Carbon;
use App\Services\ReportService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateReport implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ReportService $reportService, CurrencyService $currencyService)
    {
        $this->reportService = $reportService;
        $this->currencyService = $currencyService;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $date = Carbon::parse($event->transaction->created_at)
            ->toDateString();

        $currency = $this->currencyService->getCurrencyCode($event->transaction->currency_id);

        $tradeTypeId = $event->transaction->trade_type_id;

        switch ($$currency) {
            case 'usd':
                $this->usdTransaction($tradeTypeId, $date);
                break;
            
            case 'gbp':
                $this->gbpTransaction($tradeTypeId, $date);
                break;
            
            case 'eur':
                $this->eurTransaction($tradeTypeId, $date);
                break;
            
            default:
                $this->aedTransaction($tradeTypeId, $date);
                break;
        }

        
    }

    public function usdTransaction($tradeTypeId, $date): void
    {
        if ( $tradeTypeId === 1 ) {
            $totalPurchasedUsd = $this->reportService->getUsdPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'usd_purchased' => $totalPurchasedUsd,
                    'naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        } else {
            $totalUsdSold = $this->reportService->getUsdSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'usd_sold' => $totalUsdSold,
                    'naira_sold_value' => $totalNairaSoldValue
                ]);
        }
    }

    public function gbpTransaction($tradeTypeId, $date): void
    {
        if ($tradeTypeId === 1) {
            $totalPurchasedGbp = $this->reportService->getGbpPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'gbp_purchased' => $totalPurchasedGbp,
                    'naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        } else {
            $totalGbpSold = $this->reportService->getGbpSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'gbp_sold' => $totalGbpSold,
                    'naira_sold_value' => $totalNairaSoldValue
                ]);
        }
    }

    public function eurTransaction($tradeTypeId, $date): void
    {
        if ($tradeTypeId ===  1) {
            $totalPurchasedEur = $this->reportService->getEurPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'eur_purchased' => $totalPurchasedEur,
                    'naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        } else {
            $totalEurSold = $this->reportService->getEurSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'eur_sold' => $totalEurSold,
                    'naira_sold_value' => $totalNairaSoldValue
                ]);
        }
    }

    public function aedTransaction($tradeTypeId, $date): void
    {
        if ( $tradeTypeId === 1 ) {
            $totalPurchasedAed = $this->reportService->getAedPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'aed_purchased' => $totalPurchasedAed,
                    'naira_purchase_value' => $totalNairaPurchasedValue
                ]);
        } else {
            $totalAedSold = $this->reportService->getAedSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);
            
            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'aed_sold' => $totalAedSold,
                    'naira_sold_value' => $totalNairaSoldValue
                ]);
        }
    }
}
