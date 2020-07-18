<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Changecolumncontractperiod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_candidate', function (Blueprint $table) {
            //
            DB::statement("ALTER TABLE e_recruit.tr_candidate ALTER COLUMN contract_periode TYPE integer using 0 ");     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_candidate', function (Blueprint $table) {
            //
        });
    }
}
