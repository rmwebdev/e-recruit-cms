<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrCandidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_candidate', function (Blueprint $table) {
            $table->bigIncrements('candidate_id');
            $table->integer('job_fptk_id')->nullable();
            $table->date('received_date')->nullable();
            $table->string('subco')->nullable();
            $table->string('job_title',100)->nullable();
            $table->string('ktp_no',100)->nullable();
            $table->string('name_holder',100)->nullable();
            $table->string('function_dept',100)->nullable();
            $table->string('position_level',100)->nullable();
            $table->string('age',100)->nullable();
            $table->date('date_of_birth',100)->nullable();
            $table->string('religion',50)->nullable();
            $table->string('marital_status',50)->nullable();
            $table->text('address')->nullable();
            $table->string('phone_no',50)->nullable();
            $table->string('hp_1',50)->nullable();
            $table->string('hp_2',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('source',50)->nullable();
            $table->string('source_desc',50)->nullable();
            $table->string('edu_degree',50)->nullable();
            $table->string('edu_major',50)->nullable();
            $table->string('edu_university',50)->nullable();
            $table->string('edu_ipk',50)->nullable();
            $table->string('exp_total',50)->nullable();
            $table->integer('exp_start_year')->nullable();
            $table->integer('exp_end_year')->nullable();
            $table->string('exp_buss_sector')->nullable();
            $table->string('exp_company')->nullable();
            $table->string('exp_position')->nullable();
            $table->string('exp_salary_existing')->nullable();
            $table->string('exp_total_experience')->nullable();
            $table->integer('display')->nullable();
            $table->integer('status')->nullable();
            $table->string('process',100)->nullable();
            $table->string('result',100)->nullable();
            $table->text('remarks')->nullable();
            $table->date('date_process')->nullable();
            $table->string('berkas',500)->nullable();
            $table->string('source_entry',50)->nullable();
            $table->string('user_update',100)->nullable();
            $table->timestamp('date_update')->nullable();
            $table->string('user_delete')->nullable();
            $table->timestamp('date_delete')->nullable();
            $table->string('file_1')->nullable();
            $table->string('file_2')->nullable();
            $table->string('postal_code',10)->nullable();
            $table->integer('edu_start_year')->nullable();
            $table->integer('edu_end_year')->nullable();
            $table->string('nationality',50)->nullable();
            $table->char('exp_start_month',2)->nullable();
            $table->char('exp_end_month',2)->nullable();
            $table->text('job_desc')->nullable();
            $table->string('candidate_code',100)->nullable();


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
        Schema::dropIfExists('e_recruit.tr_candidate');
    }
}
