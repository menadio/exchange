<?php

namespace App\Console\Schedules;

use App\Models\Currency;
use App\Models\DailyReport;
use App\Models\TradeBalance;
use Carbon\Carbon;

class CloseBalance
{
    public function __invoke()
    {
        $today = Carbon::now()->toDateString();

        // close usd trade 
        $usd = Currency::where('code', 'USD')->pluck('id')->first();
        $usdBal = DailyReport::where('created_at', 'like', $today . '%')
            ->pluck('usd_bal')->first();
        $usdTradeBalance = TradeBalance::where('currency_id', $usd)
            ->where('created_at', 'like', $today . '%')
            ->first();
        $usdTradeBalance->update(['closing_balance' => $usdBal]);

        // close gbp trade
        $gbp = Currency::where('code', 'GBP')->pluck('id')->first();
        $gbpBal = DailyReport::where('created_at', 'like', $today . '%')
            ->pluck('gbp_bal')->first();
        $gbpTradeBalance = TradeBalance::where('currency_id', $gbp)
            ->where('created_at', 'like', $today . '%')
            ->first();
        $gbpTradeBalance->update(['closing_balance' => $gbpBal]);

        // close eur trade
        $eur = Currency::where('code', 'EUR')->pluck('id')->first();
        $eurBal = DailyReport::where('created_at', 'like', $today . '%')
            ->pluck('eur_bal')->first();
        $eurTradeBalance = TradeBalance::where('currency_id', $eur)
            ->where('created_at', 'like', $today . '%')
            ->first();
        $eurTradeBalance->update(['closing_balance' => $eurBal]);

        // close aed trade
        $aed = Currency::where('code', 'AED')->pluck('id')->first();
        $aedBal = DailyReport::where('created_at', 'like', $today . '%')
            ->pluck('aed_bal')->first();
        $aedTradeBalance = TradeBalance::where('currency_id', $aed)
            ->where('created_at', 'like', $today . '%')
            ->first();
        $aedTradeBalance->update(['closing_balance' => $aedBal]);

        // close ngn trade
        $ngn = Currency::where('code', 'NGN')->pluck('id')->first();
        $ngnBal = DailyReport::where('created_at', 'like', $today . '%')
            ->pluck('naira_bal')->first();
        $ngnTradeBalance = TradeBalance::where('currency_id', $ngn)
            ->where('created_at', 'like', $today . '%')
            ->first();
        $ngnTradeBalance->update(['closing_balance' => $ngnBal]);
    }
}
