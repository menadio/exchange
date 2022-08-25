<?php

namespace App\Services;

use App\Models\Currency;
use App\Models\DailyReport;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EndOfDayService
{
    private TradeBalanceService $tradeBalanceService;

    public function __construct(TradeBalanceService $tradeBalanceService)
    {
        $this->tradeBalanceService = $tradeBalanceService;
    }

    // usd end of trade report
    public function usdReport(): void
    {
        $today = Carbon::now()->toDateString();

        // get usd currency ID
        $usdId = Currency::where('code', 'USD')
            ->pluck('id')->first();

        // usd opening trade balance
        $usdOpeningBalance = $this->tradeBalanceService
            ->getOpenBalance($usdId, $today);

        // total usd purchased in cash
        $totalUsdCashPurchased = Transaction::where('currency_id', $usdId)
            ->where('trade_type_id', 1)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // total usd sold in cash
        $totalUsdCashSold = Transaction::where('currency_id',  $usdId)
            ->where('trade_type_id', 2)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // usd trade closing balance
        $usdClosingBalance = ($totalUsdCashPurchased + $usdOpeningBalance) - $totalUsdCashSold;

        // record balance
        DailyReport::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'usd_purchased' => $totalUsdCashPurchased,
                'usd_sold' => $totalUsdCashSold,
                'usd_bal' => $usdClosingBalance
            ]
        );
    }

    // gbp end of trade report
    public function gbpReport(): void
    {
        $today = Carbon::now()->toDateString();

        // get gbp currency ID
        $gbpId = Currency::where('code', 'GBP')
            ->pluck('id')->first();

        // gbp opening trade balance
        $gbpOpeningBalance = $this->tradeBalanceService
            ->getOpenBalance($gbpId, $today);

        // total usd purchased in cash
        $totalGbpCashPurchased = Transaction::where('currency_id', $gbpId)
            ->where('trade_type_id', 1)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // total usd sold in cash
        $totalGbpCashSold = Transaction::where('currency_id',  $gbpId)
            ->where('trade_type_id', 2)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // usd trade closing balance
        $gbpClosingBalance = ($totalGbpCashPurchased + $gbpOpeningBalance) - $totalGbpCashSold;

        // record balance
        DailyReport::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'gbp_purchased' => $totalGbpCashPurchased,
                'gbp_sold' => $totalGbpCashSold,
                'gbp_bal' => $gbpClosingBalance
            ]
        );
    }

    // eur end of trade report
    public function eurReport(): void
    {
        $today = Carbon::now()->toDateString();

        // get eur currency ID
        $eurId = Currency::where('code', 'EUR')
            ->pluck('id')->first();

        // eur opening trade balance
        $eurOpeningBalance = $this->tradeBalanceService
            ->getOpenBalance($eurId, $today);

        // total eur purchased in cash
        $totalEurCashPurchased = Transaction::where('currency_id', $eurId)
            ->where('trade_type_id', 1)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // total usd sold in cash
        $totalEurCashSold = Transaction::where('currency_id',  $eurId)
            ->where('trade_type_id', 2)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // usd trade closing balance
        $eurClosingBalance = ($totalEurCashPurchased + $eurOpeningBalance) - $totalEurCashSold;

        // record balance
        DailyReport::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'eur_purchased' => $totalEurCashPurchased,
                'eur_sold' => $totalEurCashSold,
                'eur_bal' => $eurClosingBalance
            ]
        );
    }

    // aed end of trade report
    public function aedReport(): void
    {
        $today = Carbon::now()->toDateString();

        // get aed currency ID
        $aedId = Currency::where('code', 'AED')
            ->pluck('id')->first();

        // usd opening trade balance
        $aedOpeningBalance = $this->tradeBalanceService
            ->getOpenBalance($aedId, $today);

        // total usd purchased in cash
        $totalAedCashPurchased = Transaction::where('currency_id', $aedId)
            ->where('trade_type_id', 1)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // total usd sold in cash
        $totalAedCashSold = Transaction::where('currency_id',  $aedId)
            ->where('trade_type_id', 2)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('amount');

        // usd trade closing balance
        $aedClosingBalance = ($totalAedCashPurchased + $aedOpeningBalance) - $totalAedCashSold;

        // record balance
        DailyReport::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'aed_purchased' => $totalAedCashPurchased,
                'aed_sold' => $totalAedCashSold,
                'aed_bal' => $aedClosingBalance
            ]
        );
    }

    // ngn end of trade report
    public function ngnReport(): void
    {
        $today = Carbon::now()->toDateString();

        // get ngn currency ID
        $ngnId = Currency::where('code', 'NGN')
            ->pluck('id')->first();

        // ngn opening trade balance
        $ngnOpeningBalance = $this->tradeBalanceService
            ->getOpenBalance($ngnId, $today);

        // total ngn purchased in cash
        $totalNgnCashPurchased = Transaction::where('trade_type_id', 2)
            ->where('channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('value');

        // total ngn sold in cash
        $totalNgnCashSold = Transaction::where('trade_type_id', 1)
            ->where('exchange_channel_id', 1)
            ->where('created_at', 'like', $today.'%')
            ->sum('value');

        Log::debug('ngn purchased: ' . $totalNgnCashPurchased);
        Log::debug('ngn sold: ' . $totalNgnCashSold);

        // ngn trade closing balance
        $ngnClosingBalance = ($totalNgnCashPurchased + $ngnOpeningBalance) - $totalNgnCashSold;

        // record balance
        DailyReport::updateOrCreate(
            ['date' => $today],
            [
                'date' => $today,
                'naira_purchase_value' => $totalNgnCashPurchased,
                'naira_sold_value' => $totalNgnCashSold,
                'naira_bal' => $ngnClosingBalance
            ]
        );
    }
}
