<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_stocks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('created_by')->index();
            $table->uuid('updated_by')->index();
            $table->string('name_product', 255);
            $table->string('category', 20);
            $table->unsignedInteger('amount');
            $table->string('satuan')->nullable();
            $table->timestamps();

            // $table->foreign('created_by')->references('id')->on('tbl_users');
            // $table->foreign('updated_by')->references('id')->on('tbl_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
