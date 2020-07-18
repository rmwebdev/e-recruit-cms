<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrHistoryProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_history_process', function (Blueprint $table) {
            $table->bigIncrements('history_proc_id');
            $table->integer('candidate_id')->nullable();
            $table->string('job_title')->nullable();
            $table->date('date_process')->nullable();
            $table->string('process')->nullable();
            $table->string('result')->nullable();
            $table->string('remarks')->nullable();
            $table->string('berkas')->nullable();
            $table->string('subco')->nullable();
            $table->string('source_entry')->nullable();
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
        Schema::dropIfExists('e_recruit.tr_history_process');
    }
}
