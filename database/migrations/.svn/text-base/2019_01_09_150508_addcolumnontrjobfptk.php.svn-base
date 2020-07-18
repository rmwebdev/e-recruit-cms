<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnontrjobfptk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_job_fptk', function (Blueprint $table) {
            //
            $table->float('salary_range_max')->nullable();
            $table->float('salary_range_min')->nullable();
            $table->string('mp_period_code',50)->nullable();
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->string('department',200)->nullable();
            $table->integer('end_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_recruit.tr_job_fptk', function (Blueprint $table) {
            //
        });
    }
}
