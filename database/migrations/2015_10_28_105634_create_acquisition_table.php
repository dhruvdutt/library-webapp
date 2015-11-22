<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcquisitionTable extends Migration
{
    public function up()
    {
        Schema::create('acquisition', function (Blueprint $table) {
            $table->string('transactionid')->unique();
            $table->primary('transactionid');
            $table->bigInteger('isbn')->unsigned();
            $table->foreign('isbn')->references('isbn')->on('publication');
            $table->integer('vendorid')->unsigned();
            $table->foreign('vendorid')->references('id')->on('vendor');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('cd');
            $table->integer('volume');
            $table->date('purchased_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('acquisition');
    }
}
