<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTrCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_course_information', function (Blueprint $table) {
            $table->bigIncrements('course_info_id');
            $table->integer('candidate_id')->unsigned()->index();
            $table->foreign('candidate_id')->references('candidate_id')->on('tr_candidate')->onDelete('cascade')->onUpdate('cascade');
            $table->string('course_type');
            $table->string('topic');
            $table->string('institution');
            $table->string('start_year');
            $table->string('end_year');
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
        Schema::dropIfExists('e_recruit.tr_course_information');
    }
}
