<?php

namespace App\Services;

use App\Events\AedTraded;
use App\Events\EurTraded;
use App\Events\GbpTraded;
use App\Events\TradeRecorded;
use App\Events\UsdTraded;
use App\Models\User;
use App\Models\Transaction;

class TradeService
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
    public function recordTrade($details): Transaction
    {
        $user = auth()->user();

        $rate = is_null($details->specialRate) ?
            $this->exchangeRateService->getRate($details->currency, $details->type) :
            $details->specialRate;

        $tradeType = $this->tradeTypeService->getType($details->type);

        $value = $this->calculateNairaValue($tradeType, $details->amount, $rate);

        $transaction = Transaction::create([
            'user_id' => $user->id,
            'currency_id' => $details->currency,
            'trade_type_id' => $details->type,
            'amount' => $details->amount,
            'rate' => $rate,
            'value' => $value,
            'channel_id' => $details->channel,
            'exchange_channel_id' => $details->exchangeChannel,
            'note' => $details->note,
        ]);

//        TradeRecorded::dispatch($transaction);

        return $transaction;
    }

    public function calculateNairaValue(string $type, int $amount, $rate)
    {
        if ($type === 'buy') {
            return $amount * $rate;
        }

        if ($type === 'sell') {
            return $amount * $rate;
        }
    }
}
