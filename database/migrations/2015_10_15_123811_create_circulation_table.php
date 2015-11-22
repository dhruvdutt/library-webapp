<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCirculationTable extends Migration
{
    public function up()
    {
        Schema::create('circulation', function (Blueprint $table) {
            $table->string('transactionid')->unique();
            $table->integer('accession_no')->unsigned();
            $table->foreign('accession_no')->references('accession_no')->on('accession');
            $table->unsignedInteger('readerid');
            $table->foreign('readerid')->references('id')->on('users');
            $table->date('issuedate');
            $table->date('returndate');
            $table->date('returneddate')->nullable();
            $table->integer('fine')->nullable();
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('circulation');
    }
}
