<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnaddresscontactpersonOnTabletrhistoryprocess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('e_recruit.tr_history_process', function (Blueprint $table) {
            //
            $table->text('history_address')->nullable();
            $table->string('history_contact_person')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tr_history_process', function (Blueprint $table) {
            //
        });
    }
}
