<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJobFptk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_job_fptk', function (Blueprint $table) {
            $table->bigIncrements('job_fptk_id');
            $table->string('job_fptk_code',50)->nullable();
            $table->char('is_internal',1)->nullable();
            $table->text('is_internal_desc')->nullable();
            $table->timestamp('request_date')->nullable();
            $table->timestamp('required_date')->nullable();
            $table->integer('request_totstaff')->nullable();
            $table->string('position_name',100)->nullable();
            $table->string('mpperiod_code',50)->nullable();
            $table->string('golongan',100)->nullable();
            $table->string('empsts',100)->nullable();
            $table->integer('yearsexperience')->nullable();
            $table->text('reason_for_hire')->nullable();
            $table->integer('salary_range_min')->nullable();
            $table->integer('salary_range_max')->nullable();
            $table->string('work_location_code',100)->nullable();
            $table->string('work_location_name',100)->nullable();
            $table->string('last_education',100)->nullable();
            $table->string('faculty_name',100)->nullable();
            $table->char('gender',1)->nullable();
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->string('married_id',50)->nullable();
            $table->text('additional_info')->nullable();
            $table->text('skill_req')->nullable();
            $table->integer('end_status')->nullable();
            $table->text('end_status_desc')->nullable();
            $table->integer('publish')->nullable();
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('benefits',100)->nullable();
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
        Schema::dropIfExists('e_recruit.tr_job_fptk');
    }
}
