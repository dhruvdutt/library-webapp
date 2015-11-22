<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessionTable extends Migration
{
    public function up()
    {
        Schema::create('accession', function (Blueprint $table) {
            $table->string('transactionid')->unique();
            $table->primary('transactionid');
            $table->bigInteger('isbn')->unsigned();
            $table->foreign('isbn')->references('isbn')->on('publication');
            $table->integer('accession_no')->unique()->unsigned();
            $table->bigInteger('class_no');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('accession');
    }
}
