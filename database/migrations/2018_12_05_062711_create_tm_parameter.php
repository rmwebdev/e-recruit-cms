<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmParameter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tm_parameters', function (Blueprint $table) {
            $table->bigIncrements('parameter_id');
            $table->integer('no_urut')->nullable();
            $table->string('kode',50)->nullable();
            $table->string('nama',50)->nullable();
            $table->string('kategori',50)->nullable();
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
        Schema::dropIfExists('e_recruit.tm_parameters');
    }
}
