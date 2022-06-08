<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping, WithProperties 
{
    use Exportable;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function properties(): array
    {
        return [
            'title'          => 'Transaction Details',
            'subject'        => 'Transactions',
        ];
    }

    public function headings(): array
    {
        return [
            'User',
            'Currency',
            'Trade Type',
            'Amount',
            'Exchange Rate',
            'Channel',
            'Date'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->user->name,
            $transaction->currency->code,
            $transaction->tradeType->name,
            $transaction->amount,
            $transaction->rate,
            $transaction->channel->name,
            $transaction->created_at
        ];
    }

    public function query()
    {
        return Transaction::query()
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate);
    }

}
