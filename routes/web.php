<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\ReportController;



Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
    ]);
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('users/download', [UserController::class, 'export'])
    ->name('users.download');

Route::get('transactions/download', [TransactionController::class, 'download'])
    ->name('transactions.download');

Route::get('reports', [ReportController::class, 'index'])
    ->name('reports.index');

Route::get('reports/summary/download', [ReportController::class, 'summary'])
    ->name('reports.summary');
    
Route::resource('users', UserController::class)
    ->middleware(['auth', 'verified']);

Route::resource('currencies', CurrencyController::class)
    ->middleware(['auth', 'verified']);

Route::resource('rates', ExchangeRateController::class)
    ->middleware(['auth', 'verified']);

Route::resource('transactions', TransactionController::class)
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
