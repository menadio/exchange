<?php

namespace App\Console\Schedules;

use App\Models\Currency;
use App\Models\TradeBalance;

class RolloverBalance
{
    public function __invoke()
    {
        // carry forward previous day trade balance
        $this->usdBalanceRollover();

        $this->gbpBalanceRollover();

        $this->eurBalanceRollover();

        $this->aedBalanceRollover();

        $this->ngnBalanceRollover();
    }

    protected function usdBalanceRollover()
    {
        $usd = Currency::where('code', 'USD')->pluck('id')->first();
        $prevUsdBalance = TradeBalance::where('currency_id', $usd)
            ->orderBy('created_at', 'desc')
            ->first();

        TradeBalance::create([
            'currency_id' => $usd,
            'opening_balance' => $prevUsdBalance->closing_balance,
            'closing_balance' => 0
        ]);
    }

    protected function gbpBalanceRollover()
    {
        $gbp = Currency::where('code', 'GBP')->pluck('id')->first();
        $prevGbpBalance = TradeBalance::where('currency_id', $gbp)
            ->orderBy('created_at', 'desc')
            ->first();

        TradeBalance::create([
            'currency_id' => $gbp,
            'opening_balance' => $prevGbpBalance->closing_balance,
            'closing_balance' => 0
        ]);
    }

    protected function eurBalanceRollover()
    {
        $eur = Currency::where('code', 'EUR')->pluck('id')->first();
        $prevEurBalance = TradeBalance::where('currency_id', $eur)
            ->orderBy('created_at', 'desc')
            ->first();

        TradeBalance::create([
            'currency_id' => $eur,
            'opening_balance' => $prevEurBalance->closing_balance,
            'closing_balance' => 0
        ]);
    }

    protected function aedBalanceRollover()
    {
        $aed = Currency::where('code', 'AED')->pluck('id')->first();
        $prevAedBalance = TradeBalance::where('currency_id', $aed)
            ->orderBy('created_at', 'desc')
            ->first();

        TradeBalance::create([
            'currency_id' => $aed,
            'opening_balance' => $prevAedBalance->closing_balance,
            'closing_balance' => 0
        ]);
    }

    protected function ngnBalanceRollover()
    {
        $ngn = Currency::where('code', 'NGN')->pluck('id')->first();
        $prevNgnBalance = TradeBalance::where('currency_id', $ngn)
            ->orderBy('created_at', 'desc')
            ->first();

        TradeBalance::create([
            'currency_id' => $ngn,
            'opening_balance' => $prevNgnBalance->closing_balance,
            'closing_balance' => 0
        ]);
    }
}
