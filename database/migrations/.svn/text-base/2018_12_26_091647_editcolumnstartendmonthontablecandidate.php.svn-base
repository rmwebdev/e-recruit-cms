<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Editcolumnstartendmonthontablecandidate extends Migration
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
                $table->dropColumn('exp_start_month');
                $table->dropColumn('exp_end_month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_recruit.tr_candidate', function (Blueprint $table) {
            //
        });
    }
}
