<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFineCollectionTable extends Migration
{

    public function up()
    {
        Schema::create('fine_collection', function (Blueprint $table) {
          $table->string('transactionid')->unique();
          $table->primary('transactionid');
          $table->string('readerid');
          $table->foreign('readerid')->references('id')->on('users');
          $table->string('fine_for');
          $table->integer('fine_amount');
          $table->date('date');
        });
    }

    public function down()
    {
        Schema::drop('fine_collection');
    }
}
