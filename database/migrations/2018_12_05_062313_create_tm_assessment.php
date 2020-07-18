<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmAssessment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tm_assessment', function (Blueprint $table) {
            $table->bigIncrements('asses_quest_id');
            $table->text('quest')->nullable();
            $table->string('quest_type',50)->nullable();
            $table->string('insert_by',25)->nullable();
            $table->timestamp('insert_time')->useCurrent();
            $table->string('update_by',25)->nullable();
            $table->timestamp('update_time')->useCurrent();
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
        Schema::dropIfExists('e_recruit.tm_assessment');
    }
}
