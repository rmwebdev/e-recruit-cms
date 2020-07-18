<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtablehistoricandidateprocess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_history_process', function (Blueprint $table) {
            $table->bigIncrements('history_process_id');
            $table->integer('candidate_id')->unsigned()->index();
            $table->foreign('candidate_id')->references('candidate_id')->on('tr_candidate')->onDelete('cascade')->onUpdate('cascade');
            $table->date('history_date')->nullable();
            $table->string('history_process')->nullable();
            $table->string('history_result')->nullable();
            $table->string('history_attachment')->nullable();
            $table->string('history_remarks')->nullable();
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
        Schema::dropIfExists('e_recruit.tr_history_process');
    }
}
