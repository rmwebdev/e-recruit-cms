<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('e_recruit.tr_users', function (Blueprint $table) {
            //
            $table->timestamp('user_delete_time')->nullable();
            $table->integer('user_delete_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('tr_users', function (Blueprint $table) {
            //
        });
    }
}
