<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\ExchangeRate;
use App\Services\ExchangeRateService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ExchangeRateController extends Controller
{
    protected $exchangeRateService;

    public function __construct(ExchangeRateService $exchangeRateService)
    {
        $this->exchangeRateService = $exchangeRateService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rates = ExchangeRate::orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Rate/Index', [
            'rates' => $rates,
            'currencies' => Currency::all()
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
            'buy' => ['required', 'numeric', 'min:1'],
            'sell' => ['required', 'numeric', 'min:1']
        ]);
        
        $rate = $this->exchangeRateService->addNewRate(
            $request->currency,
            $request->buy,
            $request->sell
        );

        if ($rate) {
            request()->session()->flash('success', 'New rate added successfully.');
            return Redirect::route('rates.index');
        } else {
            return Redirect::route('rates.index')
                ->with('error', 'Ops! Could not add rate, please try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function show(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function edit(ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExchangeRate $exchangeRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExchangeRate  $exchangeRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExchangeRate $exchangeRate)
    {
        //
    }
}
