<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usd_transactions', function (Blueprint $table) {
            $table->foreignId('exchange_channel_id')
                ->nullable()
                ->constrained('channels')
                ->after('channel_id');
            // $table->text('note')->nullable()
            //     ->after('exchange_channel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['exchange_channel_id']);
            $table->dropColumn('exchange_channel_id');
            // $table->dropColumn('note');
        });
    }
};
