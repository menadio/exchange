<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TradeService;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TransactionController extends Controller
{
    protected $tradeService;

    public function __construct(TradeService $tradeService)
    {
        $this->tradeService = $tradeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'desc')
            ->paginate(20);

        return Inertia::render('Transaction/Index', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'currency' => ['required', 'integer'],
            'type' => ['required', 'integer'],
            'channel' => ['required', 'integer'],
            'amount' => ['required', 'numeric', 'min:1']
        ]);

        $transaction = $this->tradeService->recordTrade($request);

        if ($transaction) {
            request()->session()->flash('success', 'Trade transaction recorded successfully.');
            return Redirect::route('dashboard');
        } else {
            request()->session()->flash('error', 'Ops! Failed to record trade transaction.');
            return Redirect::route('dashboard');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return Inertia::render('Transaction/Show', [
            'transaction' => $transaction
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    public function download(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        return (new TransactionsExport($startDate, $endDate))
            ->download('transactions.xlsx');
    }
}
