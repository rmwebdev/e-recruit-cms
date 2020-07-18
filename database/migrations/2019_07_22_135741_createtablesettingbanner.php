<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtablesettingbanner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tm_setting_banner', function (Blueprint $table) {
            $table->bigIncrements('setting_banner_id');
            $table->string('setting_banner_name')->nullable();
            $table->string('setting_banner_desc')->nullable();
            $table->string('setting_banner_pict')->nullable();
            $table->enum('setting_banner_type', ['warning', 'banner']);
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
        Schema::dropIfExists('e_recruit.tm_setting_banner');
    }
}
