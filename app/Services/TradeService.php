<?php

namespace App\Services;

use App\Events\TradeRecorded;
use App\Models\User;
use App\Models\Transaction;

class Tradeservice
{
    protected $exchangeRateService;
    protected $tradeTypeService;

    public function __construct(ExchangeRateService $exchangeRateService, TradeTypeService $tradeTypeService)
    {
        $this->exchangeRateService = $exchangeRateService;
        $this->tradeTypeService = $tradeTypeService;
    }

    /**
     * Records a trade transaction
     * 
     * @param User $user
     * @param int $currency
     * @param int $type
     * @param int $amount
     * @param int $channel
     * @return void
     */
    public function recordTrade(User $user, int $currency, int $type, int $amount, int $channel): Transaction
    {
        $rate = $this->exchangeRateService->getRate($currency, $type);

        $tradeType = $this->tradeTypeService->getType($type);
        
        $value = $this->calculateNairaValue($tradeType, $amount, $rate);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'currency_id' => $currency,
            'trade_type_id' => $type,
            'amount' => $amount,
            'rate' => $rate,
            'value' => $value,
            'channel_id' => $channel
        ]);

        TradeRecorded::dispatch($transaction);

        return $transaction;
    }

    public function calculateNairaValue(string $type, int $amount, $rate)
    {
        if ($type === 'buy') {
            return $amount / $rate;
        }

        if ($type === 'sell') {
            return $amount * $rate;
        }
    }
}