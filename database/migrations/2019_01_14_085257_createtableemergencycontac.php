<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createtableemergencycontac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_emergency_contact', function (Blueprint $table) {
            $table->bigIncrements('emergency_contact_id');
            $table->integer('candidate_id')->unsigned()->index();
            $table->foreign('candidate_id')->references('candidate_id')->on('e_recruit.tr_candidate')->onDelete('cascade')->onUpdate('cascade');
            $table->string('emergency_name',100)->nullable();;
            $table->text('emergency_address')->nullable();;
            $table->string('emergency_relation',100)->nullable();;
            $table->string('emergency_phone',100)->nullable();
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
        Schema::dropIfExists('e_recruit.tr_emergency_contact');
    }
}
