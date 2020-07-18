<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnforhistroyeoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_history_process', function (Blueprint $table) {
            //
            $table->string('request_job_number')->nullable();
            $table->string('project_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('entiti')->nullable();
            $table->string('division')->nullable();
            $table->string('work_location')->nullable();
            $table->string('join_date')->nullable();
            $table->string('status_contract')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_recruit.tr_history_process', function (Blueprint $table) {
            //
        });
    }
}
