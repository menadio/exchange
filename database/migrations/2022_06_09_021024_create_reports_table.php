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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('period');
            $table->double('total_usd_purchased', 15, 2);
            $table->double('total_usd_sold', 15, 2);
            $table->double('total_gbp_purchased', 15, 2);
            $table->double('total_gbp_sold', 15, 2);
            $table->double('total_eur_purchased', 15, 2);
            $table->double('total_eur_sold', 15, 2);
            $table->double('total_aed_purchased', 15, 2);
            $table->double('total_aed_sold', 15, 2);
            $table->double('total_naira_purchase_value', 15, 2);
            $table->double('total_naira_sold_value', 15, 2);
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
        Schema::dropIfExists('reports');
    }
};
