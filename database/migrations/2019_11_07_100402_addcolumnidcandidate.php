<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnidcandidate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_approval', function (Blueprint $table) {
            //
            $table->integer('candidate_id')->unsigned()->index()->nullable();
            $table->foreign('candidate_id')->references('candidate_id')->on('e_recruit.tr_candidate')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_approval', function (Blueprint $table) {
            //
        });
    }
}
