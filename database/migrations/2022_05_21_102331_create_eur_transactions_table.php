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
        Schema::create('eur_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('currency_id')->constrained();
            $table->foreignId('trade_type_id')->constrained();
            $table->float('amount', 8, 2);
            $table->unsignedBigInteger('rate');
            $table->float('value', 8, 2)->nullable();
            $table->foreignId('channel_id')->constrained();
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
        Schema::dropIfExists('eur_transactions');
    }
};
