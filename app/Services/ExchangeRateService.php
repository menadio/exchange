<?php

namespace App\Services;

use App\Models\TradeType;
use App\Models\ExchangeRate;

class ExchangeRateService
{
    /**
     * Get exchange rate for specific currency
     * trade type
     * 
     * @param int $type
     * @param int $currency
     * @return \Illuminate\Http\Response
     */
    public function getRate(int $currency, int $type): string
    {
        $tradeType = TradeType::where('id', $type)
            ->pluck('name')->first();
            
        $rate = ExchangeRate::where('currency_id', $currency)
            ->orderBy('id', 'desc')
            ->pluck($tradeType)
            ->first();

        return $rate;
    }

    /**
     * Create new exchange rate
     * 
     * @param int $currency
     * @return App\Models\ExchangeRate
     */
    public function addNewRate(int $currency, int $buyRate, int $sellRate)
    {
        $activeRates = ExchangeRate::where([
            ['currency_id', $currency], 
            ['active', true]
        ])->get();

        foreach ($activeRates as $rate) {
            $rate->update(['active' => false]);
        }

        return ExchangeRate::create([
            'currency_id' => $currency,
            'buy' => $buyRate,
            'sell' => $sellRate,
            'user_id' => auth()->user()->id
        ]);
    }

    /** 
     * Get current exchange rate
     */
    public function getcurrentRate()
    {
        return ExchangeRate::select('exchange_rates.*')
            ->join('currencies', 'currencies.id', '=', 'exchange_rates.currency_id')
            ->orderBy('currencies.id', 'asc')
            ->where('exchange_rates.active', true)
            ->get();
    }
}