<?php

namespace App\Listeners;

use App\Events\TradeRecorded;
use App\Models\AedTransaction;
use App\Models\EurTransaction;
use App\Models\GbpTransaction;
use App\Models\UsdTransaction;
use App\Services\CurrencyService;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StoreCurrencyTransaction
{
    protected $currencyService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TradeRecorded  $event
     * @return void
     */
    public function handle(TradeRecorded $event)
    {
        $currency = $this->currencyService->getCurrencyCode($event->transaction->currency_id);

        switch ($currency) {
            case 'usd':
                $this->usdTransaction($event->transaction);
                break;

            case 'eur':
                $this->eurTransaction($event->transaction);
                break;

            case 'gbp':
                $this->gbpTransaction($event->transaction);
                break;
            
            default:
                $this->aedTransaction($event->transaction);
                break;
        }
    }

    /**
     * Record Dollar transaction
     * 
     * @return void
     */
    protected function usdTransaction($transaction): void
    {
        UsdTransaction::create([
            'user_id' => $transaction->user_id,
            'currency_id' => $transaction->currency_id,
            'trade_type_id' => $transaction->trade_type_id,
            'amount' => $transaction->amount,
            'rate' => $transaction->rate,
            'value' => $transaction->value,
            'channel_id' => $transaction->channel_id,
            'exchange_channel_id' => $transaction->exchange_channel_id,
            'note' => $transaction->note,
        ]);
    }

    /**
     * Record Euro transaction
     * 
     * @return void
     */
    protected function eurTransaction($transaction): void
    {
        EurTransaction::create([
            'user_id' => $transaction->user_id,
            'currency_id' => $transaction->currency_id,
            'trade_type_id' => $transaction->trade_type_id,
            'amount' => $transaction->amount,
            'rate' => $transaction->rate,
            'value' => $transaction->value,
            'channel_id' => $transaction->channel_id,
            'exchange_channel_id' => $transaction->exchange_channel_id,
            'note' => $transaction->note,
        ]);
    }

    /**
     * Record Pounds transaction
     * 
     * @return void
     */
    protected function gbpTransaction($transaction): void
    {
        GbpTransaction::create([
            'user_id' => $transaction->user_id,
            'currency_id' => $transaction->currency_id,
            'trade_type_id' => $transaction->trade_type_id,
            'amount' => $transaction->amount,
            'rate' => $transaction->rate,
            'value' => $transaction->value,
            'channel_id' => $transaction->channel_id,
            'exchange_channel_id' => $transaction->exchange_channel_id,
            'note' => $transaction->note,
        ]);
    }

    /**
     * Record Dirham transaction
     * 
     * @return void
     */
    protected function aedTransaction($transaction): void
    {
        AedTransaction::create([
            'user_id' => $transaction->user_id,
            'currency_id' => $transaction->currency_id,
            'trade_type_id' => $transaction->trade_type_id,
            'amount' => $transaction->amount,
            'rate' => $transaction->rate,
            'value' => $transaction->value,
            'channel_id' => $transaction->channel_id,
            'exchange_channel_id' => $transaction->exchange_channel_id,
            'note' => $transaction->note,
        ]);
    }
}
