<?php

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendor')->insert(array(
            #Admin
            array('name' => 'Warren Buffett','contact' => '9876543210','address'=>'Vadodara'),
            array('name' => 'Jack Ma','contact' => '9876543210','address'=>'Ahemdabad'),
            array('name' => 'Michael Bloomberg','contact' => '9876543210','address'=>'Surat'),
            array('name' => 'Dilip Shanghvi','contact' => '9876543210','address'=>'Gandhinagar'),
            array('name' => 'Michael Dell','contact' => '9876543210','address'=>'Rajkot')
        ));    
    }
}
