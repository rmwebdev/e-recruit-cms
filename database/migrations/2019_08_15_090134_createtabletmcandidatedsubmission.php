<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtabletmcandidatedsubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tm_candidate_submission', function (Blueprint $table) {
            $table->bigIncrements('candidate_submission_id');
            $table->integer('job_fptk_id')->unsigned()->index()->nullable();
            $table->foreign('job_fptk_id')->references('job_fptk_id')->on('e_recruit.tr_job_fptk')->onDelete('cascade')->onUpdate('cascade');
            $table->string('submission_person')->nullable();
            $table->string('submission_position')->nullable();
            $table->string('submission_company')->nullable();
            $table->timestamp('request_date_submission')->nullable();
            $table->timestamp('date_submission_employee')->nullable();
            $table->string('insert_by')->nullable();
            $table->timestamp('insert_time')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamp('update_time')->nullable();
            $table->string('delete_by')->nullable();
            $table->datetime('delete_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_candidate_submission');
    }
}
