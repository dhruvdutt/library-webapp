<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationTable extends Migration
{

    public function up()
    {
        Schema::create('publication', function (Blueprint $table) {
            $table->bigInteger('isbn')->unique()->unsigned();
            $table->primary('isbn');
            $table->string('title');
            $table->string('author');
            $table->string('publisher');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('publication');
    }
}
