<?php

use App\Http\Controllers\AdminController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExchangeRateController;
use App\Http\Controllers\TradeBalanceController;

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
    ]);
});

Route::get('admin/ops/cache-clear', [AdminController::class, 'cacheClear']);

Route::get('admin/ops/config-clear', [AdminController::class, 'configClear']);

Route::get('admin/ops/config-cache', [AdminController::class, 'configCache']);

Route::get('admin/ops/route-clear', [AdminController::class, 'routeClear']);

Route::get('admin/ops/route-cache', [AdminController::class, 'routeCache']);

Route::get('admin/ops/view-clear', [AdminController::class, 'viewClear']);

Route::get('admin/ops/view-cache', [AdminController::class, 'viewCache']);

Route::get('admin/ops/migrate', [AdminController::class, 'migrate']);

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::get('users/download', [UserController::class, 'export'])
    ->name('users.download');

Route::put('password/change', [SettingsController::class, 'passwordUpdate'])
    ->middleware(['auth'])->name('password.change');

Route::get('transactions/download', [TransactionController::class, 'download'])
    ->name('transactions.download');

Route::get('reports', [ReportController::class, 'index'])
    ->name('reports.index');

Route::get('reports/summary/download', [ReportController::class, 'summary'])
    ->name('reports.summary');

Route::get('settings', [SettingsController::class, 'index'])
    ->middleware(['auth'])->name('settings');


Route::resource('users', UserController::class)
    ->middleware(['auth']);

Route::resource('currencies', CurrencyController::class)
    ->middleware(['auth']);

Route::resource('rates', ExchangeRateController::class)
    ->middleware(['auth']);

Route::resource('transactions', TransactionController::class)
    ->middleware(['auth']);

Route::resource('trade-balances', TradeBalanceController::class)
    ->middleware(['auth']);


require __DIR__ . '/auth.php';
