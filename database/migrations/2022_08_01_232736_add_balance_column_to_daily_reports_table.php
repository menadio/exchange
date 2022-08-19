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
        Schema::table('daily_reports', function (Blueprint $table) {
            $table->double('usd_bal', 15, 2)
                ->nullable()
                ->after('usd_sold');
            $table->double('gbp_bal', 15, 2)
                ->nullable()
                ->after('gbp_sold');
            $table->double('eur_bal', 15, 2)
                ->nullable()
                ->after('eur_sold');
            $table->double('aed_bal', 15, 2)
                ->nullable()
                ->after('aed_sold');
            $table->double('naira_bal', 15, 2)
                ->nullable()
                ->after('naira_sold_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('daily_reports', function (Blueprint $table) {
            //
        });
    }
};
