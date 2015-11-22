<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	# Truncate all TABLES
        DB::table('users')->delete();
        DB::table('vendor')->delete();
        DB::table('publication')->delete();

        # Resetting Auto-Increment Index
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE vendor AUTO_INCREMENT = 1');

        $password = Hash::make('1234'); #Students/Faculty Password
        $superuser = Hash::make('admin'); #Admin Password
        $login_first_time = 'yes';

        DB::table('users')->insert(array(
            #Admin
            array('name' => 'admin','type' => 'admin','department' => 'ca','year' => 'faculty', 'password' => $superuser,'login_first_time'=>$login_first_time),
            #Faculties
            array('name' => 'Sundar Pichai','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Satya Nadella','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Bill Gates','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Mark Zuckerberg','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Larry Page','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Sergey Brin','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Steve Jobs','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Steve Wozniak','type' => 'faculty','department' => 'ca','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            #FY Students
            array('name' => 'Johnny Depp','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Tom Cruise','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Hugh Jackman','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Vin Diesel','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Russell Crowe','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Russell Peters','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Brad Pitt','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Brad Adams','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Kevin Spacey','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Robert Downey','type' => 'student','department' => 'ca','year' => 'fy','password' => $password,'login_first_time'=>$login_first_time),
            #SY Students
            array('name' => 'Tom Hardy','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Simon Baker','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Denzel Washington','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Angelina Jolie','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Tom Riddle','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'John Travolta','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Arnold Schwarzenegger','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Sylvester Stallone','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Christian Bale','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Morgan Freeman','type' => 'student','department' => 'ca','year' => 'sy','password' => $password,'login_first_time'=>$login_first_time),
            #TY Students
            array('name' => 'Edward Norton','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Bruce Willis','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Tom Hanks','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Will Smith','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Matt Damon','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'George Clooney','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Leonardo DiCaprio','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Sandra Bullock','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Megan Fox','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time),
            array('name' => 'Gerard Butler','type' => 'student','department' => 'ca','year' => 'ty','password' => $password,'login_first_time'=>$login_first_time)
            ));
    }
}
