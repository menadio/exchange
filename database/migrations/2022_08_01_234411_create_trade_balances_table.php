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
        Schema::create('trade_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('currency_id')
                ->constrained();
            $table->double('opening_balance', 15, 2)
                ->nullable();
            $table->double('closing_balance', 15, 2)
                ->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trade_balances');
    }
};
