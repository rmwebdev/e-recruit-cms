<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrJobRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_job_registration', function (Blueprint $table) {
            $table->bigIncrements('job_regist_id');
            $table->string('code_job_regist',50)->nullable();
            $table->string('subco',50)->nullable();
            $table->string('job_regist_title',50)->nullable();
            $table->string('position_level',50)->nullable();
            $table->string('function_dept',50)->nullable();
            $table->string('key_action',50)->nullable();
            $table->date('received_fptk')->nullable();
            $table->string('pp',100)->nullable();
            $table->integer('wt')->nullable();
            $table->integer('nwt')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('hired')->nullable();
            $table->text('remark')->nullable();
            $table->integer('display')->nullable();
            $table->integer('status')->nullable();
            $table->text('notes')->nullable();
            $table->string('user_create',50)->nullable();
            $table->timestamp('user_update')->useCurrent();
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
        Schema::dropIfExists('e_recruit.tr_job_registration');
    }
}
