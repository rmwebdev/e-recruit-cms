<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtablejobfptk extends Migration
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
            $table->string('request_job_number')->nullable();
            $table->date('received_date_fptk')->nullable();
            $table->date('required_date_fptk')->nullable();
            $table->string('hired')->nullable();
            $table->string('recruitment_type')->nullable();
            $table->string('recruitment_code')->nullable();
            $table->date('request_date')->nullable();
            $table->date('mpp_periode')->nullable();
            $table->date('effective_date')->nullable();
            $table->string('request_reason')->nullable();
            $table->string('position_name')->nullable();
            $table->string('recruitment_plan')->nullable();
            $table->string('requested_staff')->nullable();
            $table->string('golongan')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('salary_range')->nullable();
            $table->string('ehrmpointofhire')->nullable();
            $table->string('work_location')->nullable();
            $table->string('work_system')->nullable();
            $table->string('cost_center')->nullable();
            $table->string('reason_hiring')->nullable();
            $table->string('job_title')->nullable();
            $table->string('education')->nullable();
            $table->string('faculty')->nullable();
            $table->string('gpa')->nullable();
            $table->string('experience_year')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('additional_information')->nullable();
            $table->string('skill')->nullable();
            $table->text('description')->nullable();
            $table->text('requirement')->nullable();
            $table->string('benefit')->nullable();
            $table->string('publish')->nullable();
            $table->string('status')->nullable();
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
        // Schema::dropIfExists('e_recruit.tr_job_fptk');
    }
}
