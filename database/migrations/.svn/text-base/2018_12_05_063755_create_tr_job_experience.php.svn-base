<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrJobExperience extends Migration
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
            $table->integer('candidate_comp_id')->nullable();
            $table->string('company_name',50)->nullable();
            $table->string('position_exp',50)->nullable();
            $table->text('company_address')->nullable();
            $table->integer('current_salary')->nullable();
            $table->text('terminated_reason')->nullable();
            $table->date('start_job_exp')->nullable();
            $table->date('end_job_exp')->nullable();
            $table->string('insert_by',25)->nullable();
            $table->timestamp('insert_time')->useCurrent();
            $table->string('update_by',25)->nullable();
            $table->timestamp('update_time')->useCurrent() ; 
            $table->string('delete_by',25)->nullable();
            $table->timestamp('delete_time')->useCurrent() ;
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
        Schema::dropIfExists('e_recruit.tr_job_experience');
    }
}
