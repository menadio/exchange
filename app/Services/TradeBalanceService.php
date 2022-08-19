<?php

namespace App\Services;

use App\Models\TradeBalance;
use Carbon\Carbon;

class TradeBalanceService
{
    /**
     * Fetch collection of currency trading balance
     */
    public function getTradeBalances()
    {
        return TradeBalance::orderBy('created_at', 'desc')
            ->paginate(20);
    }

    /** 
     * get current trade balance of currencies
     */
    public function getCurrentCurrencyTradeBalance()
    {
        $now = Carbon::now()->toDateString();

        return TradeBalance::where('created_at', 'like', $now . '%')
            ->get();
    }

    /**
     * Create a& store trade balance record
     * 
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\TradeBalance
     */
    public function createTradeBalance($request)
    {
        return TradeBalance::create([
            'currency_id' => $request->currency_id,
            'opening_balance' => $request->opening_balance,
            'closing_balance' => $request->closing_balance,
            'user_id' => auth()->user()->id
        ]);
    }

    /**
     * Get currency open trade balance
     */
    public function getOpenBalance($currencyId, $date)
    {
        return TradeBalance::where('currency_id', $currencyId)
            ->where('created_at', 'like', $date . '%')
            ->orderBy('created_at', 'desc')
            ->pluck('opening_balance')
            ->first();
    }
}
