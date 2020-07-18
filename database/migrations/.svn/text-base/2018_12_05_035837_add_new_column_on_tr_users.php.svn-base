<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnOnTrUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tr_users', function (Blueprint $table) {
                $table->bigIncrements('user_id');
                $table->string('name');
                $table->string('email');
                $table->string('password');
                $table->string('remember_token');
                $table->string('nip')->nullable();
                $table->string('function_dept',50)->nullable();
                $table->text('address')->nullable();
                $table->string('hp',50)->nullable();
                $table->date('effective_date')->nullable();
                $table->date('end_date')->nullable();
                $table->string('username')->nullable();
                $table->string('user_update')->nullable();
                $table->timestamp('date_update')->nullable();
                $table->string('level_user');
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
        Schema::table('e_recruit.tr_users', function (Blueprint $table) {
            //
        });
    }
}
