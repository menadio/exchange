<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Models\TradeType;
use App\Models\Transaction;
use App\Services\ExchangeRateService;
use App\Services\TradeBalanceService;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $balanceService;

    public function __construct(TradeBalanceService $tradeBalanceService)
    {
        $this->tradeBalanceService = $tradeBalanceService;
    }

    public function index(ExchangeRateService $exchangeRateService)
    {
        $today = now()->toDateString();

        $rates = $exchangeRateService->getcurrentRate();
        $transactions = Transaction::where('created_at', 'like', $today . '%')
            ->orderBy('id', 'desc')->get();
        $currencies = Currency::all();
        $types = TradeType::all();
        $channels = Channel::all();
        $balances = $this->tradeBalanceService->getCurrentCurrencyTradeBalance();

        return Inertia::render(
            'Dashboard',
            [
                'rates' => $rates,
                'transactions' => $transactions,
                'currencies' => $currencies,
                'types' => $types,
                'channels' => $channels,
                'balances' => $balances
            ]
        );
    }
}
