<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Services\TradeBalanceService;
use Illuminate\Support\Facades\Redirect;

class TradeBalanceController extends Controller
{
    protected $tradeBalanceService;

    public function __construct(TradeBalanceService $tradeBalanceService)
    {
        $this->tradeBalanceService = $tradeBalanceService;
    }

    /**
     * List currency balance collection
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tradeBalances = $this->tradeBalanceService->getTradeBalances();

        return Inertia::render('Trade/Index', [
            'tradeBalances' => $tradeBalances,
            'currencies' => Currency::all()
        ]);
    }

    /**
     * Store new trade balance resource
     * 
     * @param \Illuminate\Http\Request $reques
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tradeBalance = $this->tradeBalanceService->createTradeBalance($request);

        if ($tradeBalance) {
            request()->session()->flash('success', 'Recorded trade balance successfully.');
            return Redirect::route('trade-balances.index');
        } else {
            return Redirect::route('trade-balances.index')
                ->with('error', 'Ops! Could not add rate, please try again later.');
        }
    }
}
