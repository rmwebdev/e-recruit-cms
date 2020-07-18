<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtableinterest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_job_interest', function (Blueprint $table) {
            $table->bigIncrements('job_interest_id');
            $table->integer('candidate_id')->unsigned()->index();
            $table->foreign('candidate_id')->references('candidate_id')->on('e_recruit.tr_candidate')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type_of_work',200)->nullable();;
            $table->integer('sort')->nullable();;
            $table->string('insert_by',100)->nullable();
            $table->timestamp('insert_time')->nullable();
            $table->string('update_by',100)->nullable();
            $table->timestamp('update_time')->nullable();
            $table->string('delete_by',100)->nullable();
            $table->timestamp('delete_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tr_job_interest');
    }
}
