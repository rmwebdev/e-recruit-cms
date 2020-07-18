<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInsertByInsertTimeUpdateByDll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_candidate', function (Blueprint $table) {
            //
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
        Schema::table('e_recruit.tr_candidate', function (Blueprint $table) {
            //
        });
    }
}
