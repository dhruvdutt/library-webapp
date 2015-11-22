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

        Model::reguard();
    }
}
