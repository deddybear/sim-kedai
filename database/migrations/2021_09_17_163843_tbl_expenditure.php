<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblExpenditure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_expenditure', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('created_by')->index();
            $table->uuid('updated_by')->index();
            $table->string('description', 255);
            $table->string('category', 20);
            $table->unsignedDecimal('nominal', 13, 0);
            $table->unsignedInteger('amount');
            $table->unsignedInteger('total');
            $table->string('unit');
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
        Schema::dropDatabaseIfExists('tbl_expenditure');
    }
}
