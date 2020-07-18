<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobExperienceForNewColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_job_experience', function (Blueprint $table) {
            $table->bigIncrements('job_exp_id');
            $table->integer('candidate_id')->unsigned()->index();
            $table->foreign('candidate_id')->references('candidate_id')->on('tr_candidate')->onDelete('cascade')->onUpdate('cascade');
            $table->string('company_name');
            $table->string('position_exp');
            $table->string('company_address');
            $table->string('terminated_reason');
            $table->string('current_salary');
            $table->string('start_job_exp');
            $table->string('end_job_exp');
            $table->string('job_exp_desc')->nullable();
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
        Schema::dropIfExists('e_recruit.tr_job_experience');
    }
}
