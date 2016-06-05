<?php

use Illuminate\Database\Seeder;

class IssueRestrictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('issue_restriction')->insert([
          ['transactionid'=>'sSvlkc','for'=>'fybca','days'=>7,'books_for_issue'=>1,'fine'=>2],
          ['transactionid'=>'kjdfLk','for'=>'sybca','days'=>14,'books_for_issue'=>2,'fine'=>2],
          ['transactionid'=>'lkfmcD','for'=>'tybca','days'=>21,'books_for_issue'=>3,'fine'=>2],
          ['transactionid'=>'sfCgbe','for'=>'fymsc','days'=>21,'books_for_issue'=>4,'fine'=>2],
          ['transactionid'=>'FGvGFs','for'=>'symsc','days'=>21,'books_for_issue'=>5,'fine'=>2],
          ['transactionid'=>'lcMkdv','for'=>'faculty','days'=>90,'books_for_issue'=>5,'fine'=>0]
        ]);
    }
}
