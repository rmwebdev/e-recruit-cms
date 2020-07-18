<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumntambahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_users', function (Blueprint $table) {
            //
            $table->string('division')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('job_desc')->nullable();
            $table->string('cost_center')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_users', function (Blueprint $table) {
            //
        });
    }
}
