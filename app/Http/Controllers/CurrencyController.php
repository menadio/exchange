<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();

        return Inertia::render('Currency/Index', ['currencies' => $currencies]);
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
            'name' => ['required', 'string', 'unique:currencies,name'],
            'code' => ['required', 'string', 'unique:currencies,code']
        ]);

        $currency = Currency::create([
            'name' => $request->name,
            'code' => $request->code
        ]);

        if ($currency) {
            request()->session()->flash('success', 'New currency added successfully.');
            return Redirect::route('currencies.index');
        } else {
            request()->session()->flash('error', 'Ops! Something went wrong, please try again.');
            return Redirect::route('currencies.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}
