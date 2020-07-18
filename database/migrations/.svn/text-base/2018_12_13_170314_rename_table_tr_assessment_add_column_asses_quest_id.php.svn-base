<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTableTrAssessmentAddColumnAssesQuestId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_assessment', function (Blueprint $table) {
            //
            $table->integer('asses_quest_id')->after('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('e_recruit.tr_assessment', function (Blueprint $table) {
            //
        });
    }
}
