<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'dollar', 'code' => 'USD'],
            ['name' => 'pounds', 'code' => 'GBP'],
            ['name' => 'euros', 'code' => 'EUR'],
            ['name' => 'dirham', 'code' => 'AED']
        ];

        foreach ( $currencies as $currency ) {
            Currency::updateOrInsert(
                ['name' => $currency['name']],
                [
                    'name' => $currency['name'],
                    'code' => $currency['code'],
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
