<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueRestrictionTable extends Migration
{

    public function up()
    {
        Schema::create('issue_restriction', function (Blueprint $table) {
          $table->string('transactionid')->unique();
          $table->primary('transactionid');
          $table->string('for');
          $table->integer('days');
          $table->integer('books_for_issue');
          $table->integer('fine')->nullable();
          $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('issue_restriction');
    }
}
