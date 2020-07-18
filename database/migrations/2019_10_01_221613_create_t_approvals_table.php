<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_recruit.tr_approval', function (Blueprint $table) {
            $table->bigIncrements('approval_id');
            $table->unsignedBigInteger('job_fptk_id')->nullable();    
            $table->foreign('job_fptk_id')->references('job_fptk_id')->on('e_recruit.tr_job_fptk')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();    
            $table->foreign('user_id')->references('user_id')->on('e_recruit.tr_users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('approval_status')->nullable();
            $table->timestamp('approval_date')->nullable();
            $table->text('approval_desc')->nullable();
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
        Schema::dropIfExists('tr_approval');
    }
}
