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
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->double('usd_purchased', 15, 2)->nullable();
            $table->double('usd_sold', 15, 2)->nullable();
            $table->double('gbp_purchased', 15, 2)->nullable();
            $table->double('gbp_sold', 15, 2)->nullable();
            $table->double('eur_purchased', 15, 2)->nullable();
            $table->double('eur_sold', 15, 2)->nullable();
            $table->double('aed_purchased', 15, 2)->nullable();
            $table->double('aed_sold', 15, 2)->nullable();
            $table->double('naira_purchase_value', 15, 2)->nullable();
            $table->double('naira_sold_value', 15, 2)->nullable();
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
        Schema::dropIfExists('daily_reports');
    }
};
