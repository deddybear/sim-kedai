<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_activitys', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->text('activity');
            $table->timestamp('created_at');

            // $table->foreign('user_id')->references('id')->on('tbl_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_activitys');
    }
}
