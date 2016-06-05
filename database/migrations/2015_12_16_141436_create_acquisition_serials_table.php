<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquisitionSerialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acquisition_serials', function (Blueprint $table) {
            $table->string('transactionid')->unique();
            $table->primary('transactionid');
            $table->string('serial_no');
            $table->foreign('serial_no')->references('serial_no')->on('serials');
            $table->integer('vendorid')->unsigned();
            $table->foreign('vendorid')->references('id')->on('vendor');
            $table->integer('volume');
            $table->string('issue_no');
            $table->string('month');
            $table->string('year');
            $table->integer('price');
            $table->integer('quantity');
            $table->date('purchased_date');
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
        Schema::drop('acquisition_serials');
    }
}
