<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropcolumnontrJobFptk extends Migration
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
            $table->dropColumn(['recruitment_code', 'job_title', 'salary_range','request_date','effective_date','gpa','mpp_periode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_job_fptk', function (Blueprint $table) {
            //
        });
    }
}
