<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');

        $this->call('VendorTableSeeder');
        $this->command->info('Vendor table seeded!');

        $this->call('PublicationTableSeeder');
        $this->command->info('Publication table seeded!');

        $this->call('IssueRestrictionSeeder');
        $this->command->info('Issue Restriction table seeded!');

        Model::reguard();
    }
}

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

