<?php

namespace Database\Seeders;

use App\Models\TradeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TradeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'buy', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'sell', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($types as $type) {
            TradeType::updateOrInsert(
                ['name' => $type['name']],
                [
                    'name' => $type['name'],
                    'created_at' => $type['created_at'],
                    'updated_at' => $type['updated_at']
                ]
            );
        }
    }
}
