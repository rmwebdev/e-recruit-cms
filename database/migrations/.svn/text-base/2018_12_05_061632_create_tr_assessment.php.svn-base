<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_assessment', function (Blueprint $table) {
            $table->bigIncrements('asses_answer_id');
            $table->integer('asses_ques_id')->nullable();
            $table->integer('candidate_comp_id')->nullable();
            $table->string('answer')->nullable();
            $table->text('remarks')->nullable();
            $table->string('insert_by',25)->nullable();
            $table->timestamp('insert_time')->useCurrent();
            $table->string('update_by',25)->nullable();
            $table->timestamp('update_time')->nullable();
            $table->string('delete_by',25)->nullable();
            $table->timestamp('delete_time')->useCurrent();
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
        Schema::dropIfExists('e_recruit.tr_assessment');
    }
}
