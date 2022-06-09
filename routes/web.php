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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        // 'canRegister' => Route::has('register'),
        // 'laravelVersion' => Application::VERSION,
        // 'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::get('users/download', [UserController::class, 'export'])
    ->name('users.download');

Route::get('transactions/download', [TransactionController::class, 'download'])
    ->name('transactions.download');

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    
Route::resource('users', UserController::class)
    ->middleware(['auth', 'verified']);

Route::resource('currencies', CurrencyController::class)
    ->middleware(['auth', 'verified']);

Route::resource('rates', ExchangeRateController::class)
    ->middleware(['auth', 'verified']);

Route::resource('transactions', TransactionController::class)
    ->middleware(['auth', 'verified']);


require __DIR__.'/auth.php';
