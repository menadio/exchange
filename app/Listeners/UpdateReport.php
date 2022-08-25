<?php

namespace App\Listeners;

use App\Models\DailyReport;
use App\Models\Report;
use App\Services\BalanceService;
use App\Services\CurrencyService;
use Carbon\Carbon;
use App\Services\ReportService;
use App\Services\TradeBalanceService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdateReport implements ShouldQueue
{
    /**
     * The time (seconds) before the job should be processed.
     *
     * @var int
     */
    public $delay = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        ReportService $reportService,
        CurrencyService $currencyService,
        BalanceService $balanceService,
        TradeBalanceService $tradeBalanceService
    ) {
        $this->reportService = $reportService;
        $this->currencyService = $currencyService;
        $this->balanceService = $balanceService;
        $this->tradeBalanceService = $tradeBalanceService;
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

        $currency = $this->currencyService
            ->getCurrencyCode($event->transaction->currency_id);

        $currencyId = $event->transaction->currency_id;

        $tradeTypeId = $event->transaction->trade_type_id;

        // customer transaction channel
        $customerChannel = $event->transaction->channel_id;

        // business transaction channel
        $businessChannel = $event->transaction->exchange_channel_id;

        switch (strtolower($currency)) {
            case 'usd':
                $this->usdTransaction(
                    $tradeTypeId,
                    $date,
                    $currencyId,
                    $customerChannel,
                    $businessChannel
                );
                break;

            case 'gbp':
                $this->gbpTransaction($tradeTypeId, $date, $currencyId);
                break;

            case 'eur':
                $this->eurTransaction($tradeTypeId, $date, $currencyId);
                break;

            default:
                $this->aedTransaction($tradeTypeId, $date, $currencyId);
                break;
        }
    }

    public function usdTransaction($tradeTypeId, $date, $currency, $customerChannel, $businessChannel): void
    {
        $usdBal = $this->balanceService->getUsdTradingBalance($date);
        $ngnBal = $this->balanceService->getNgnTradingBalance($date);

        $currentUsdBal = is_null($usdBal) ?
            $this->tradeBalanceService->getOpenBalance($currency, $date) :
            $usdBal;

        $currentNgnBal = is_null($ngnBal) ?
            $this->tradeBalanceService->getOpenBalance(5, $date) :
            $ngnBal;

        if ($tradeTypeId === 1) {
            // purchase transaction
            $totalPurchasedUsd = $this->reportService->cashUsdPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->cashNairaPurchased($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'usd_purchased' => $totalPurchasedUsd,
                    'usd_bal' => ($customerChannel === 1) ? $totalPurchasedUsd + $currentUsdBal : $currentUsdBal,
                    'naira_purchase_value' => $totalNairaPurchasedValue,
                    'naira_bal' => ($businessChannel === 1) ? $currentNgnBal - $totalNairaPurchasedValue : $currentNgnBal
                ]);
        } else {
            // selling transaction
            $totalUsdSold = $this->reportService->getUsdSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'usd_sold' => $totalUsdSold,
                    'usd_bal' => $currentUsdBal - $totalUsdSold,
                    'naira_sold_value' => $totalNairaSoldValue,
                    'naira_bal' => $currentNgnBal + $totalNairaSoldValue
                ]);
        }
    }

    public function gbpTransaction($tradeTypeId, $date, $currency): void
    {
        $gbpBal = $this->balanceService->getGbpTradingBalance($date);
        $ngnBal = $this->balanceService->getNgnTradingBalance($date);

        $currentGbpBal = is_null($gbpBal) ?
            $this->tradeBalanceService->getOpenBalance($currency, $date) :
            $gbpBal;

        $currentNgnBal = is_null($ngnBal) ?
            $this->tradeBalanceService->getOpenBalance(5, $date) :
            $ngnBal;

        if ($tradeTypeId === 1) {

            $totalPurchasedGbp = $this->reportService->getGbpPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'gbp_purchased' => $totalPurchasedGbp,
                    'gbp_bal' => $totalPurchasedGbp + $currentGbpBal,
                    'naira_purchase_value' => $totalNairaPurchasedValue,
                    'naira_bal' => $currentNgnBal - $totalNairaPurchasedValue
                ]);
        } else {
            $totalGbpSold = $this->reportService->getGbpSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'gbp_sold' => $totalGbpSold,
                    'gbp_bal' => $currentGbpBal - $totalGbpSold,
                    'naira_sold_value' => $totalNairaSoldValue,
                    'naira_bal' => $currentNgnBal + $totalNairaSoldValue
                ]);
        }
    }

    public function eurTransaction($tradeTypeId, $date, $currency): void
    {
        $eurBal = $this->balanceService->getEurTradingBalance($date);
        $ngnBal = $this->balanceService->getNgnTradingBalance($date);

        $currentEurBal = is_null($eurBal) ?
            $this->tradeBalanceService->getOpenBalance($currency, $date) :
            $eurBal;

        $currentNgnBal = is_null($ngnBal) ?
            $this->tradeBalanceService->getOpenBalance(5, $date) :
            $ngnBal;

        if ($tradeTypeId ===  1) {
            $totalPurchasedEur = $this->reportService->getEurPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'eur_purchased' => $totalPurchasedEur,
                    'eur_bal' => $currentEurBal + $totalPurchasedEur,
                    'naira_purchase_value' => $totalNairaPurchasedValue,
                    'naira_bal' => $currentNgnBal - $totalNairaPurchasedValue
                ]);
        } else {
            $totalEurSold = $this->reportService->getEurSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'eur_sold' => $totalEurSold,
                    'eur_bal' => $currentEurBal - $totalEurSold,
                    'naira_sold_value' => $totalNairaSoldValue,
                    'naira_bal' => $currentNgnBal + $totalNairaSoldValue
                ]);
        }
    }

    public function aedTransaction($tradeTypeId, $date, $currency): void
    {
        $aedBal = $this->balanceService->getAedTradingBalance($date);
        $ngnBal = $this->balanceService->getNgnTradingBalance($date);

        $currentAedBal = is_null($aedBal) ?
            $this->tradeBalanceService->getOpenBalance($currency, $date) :
            $aedBal;

        $currentNgnBal = is_null($ngnBal) ?
            $this->tradeBalanceService->getOpenBalance(5, $date) :
            $ngnBal;

        if ($tradeTypeId === 1) {
            $totalPurchasedAed = $this->reportService->getAedPurchased($date);
            $totalNairaPurchasedValue = $this->reportService->getNairaPurchaseValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'aed_purchased' => $totalPurchasedAed,
                    'aed_bal' => $currentAedBal + $totalPurchasedAed,
                    'naira_purchase_value' => $totalNairaPurchasedValue,
                    'naira_bal' => $currentNgnBal - $totalNairaPurchasedValue
                ]);
        } else {
            $totalAedSold = $this->reportService->getAedSold($date);
            $totalNairaSoldValue = $this->reportService->getNairaSoldValue($date);

            DailyReport::where('date', Carbon::parse($date)->format('d/m/Y'))
                ->update([
                    'aed_sold' => $totalAedSold,
                    'aed_bal' => $currentAedBal - $totalAedSold,
                    'naira_sold_value' => $totalNairaSoldValue,
                    'naira_bal' => $currentNgnBal + $totalNairaSoldValue
                ]);
        }
    }
}
