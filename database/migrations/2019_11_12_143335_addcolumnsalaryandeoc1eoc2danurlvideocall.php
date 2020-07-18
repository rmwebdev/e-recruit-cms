<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addcolumnsalaryandeoc1eoc2danurlvideocall extends Migration
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
            $table->float('salary')->nullable();
            $table->float('benefits')->nullable();
            $table->string('eoc_1')->nullable();
            $table->string('eoc_2')->nullable();
            $table->string('link_video_call')->nullable();
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
