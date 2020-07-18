<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addstate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tm_state', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name',200);
            $table->string('insert_by',100)->nullable();
            $table->timestamp('insert_time')->nullable();
            $table->string('update_by',100)->nullable();
            $table->timestamp('update_time')->nullable();
            $table->string('delete_by',100)->nullable();
            $table->timestamp('delete_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_state');
    }
}
