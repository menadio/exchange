<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            ['name' => 'cash', 'description' => 'Cash deposited on site', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'transfer', 'description' => 'Cash transfered to bank account', 'created_at' => now(), 'updated_at' => now()]
        ];

        foreach ($channels as $channel) {
            Channel::updateOrInsert(
                ['name' => $channel['name']],
                [
                    'name' => $channel['name'],
                    'description' => $channel['description'],
                    'created_at' => $channel['created_at'],
                    'updated_at' => $channel['updated_at']
                ]
            );
        }
    }
}
