<?php

use Illuminate\Database\Seeder;
use App\Publication;

class PublicationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #Publication::truncate();
        factory(Publication::class,20)->create();
    }
}
