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
        # Resetting Auto-Increment Index
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE vendor AUTO_INCREMENT = 1');

        $password = Hash::make('1234'); #Students/Faculty Password
        $superuser = Hash::make('admin'); #Admin Password
        $login_first_time = 'yes';
        $year_enrolled = 2015;
        DB::table('users')->insert(array(
            #Admin
            array('id'=>'admin','name' => 'admin','type' => 'admin','department' => 'CA','year' => 'faculty', 'password' => $superuser,'login_first_time'=>$login_first_time),
            #Faculties
            array('id'=>'CA2015001','name' => 'Sundar Pichai','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015002','name' => 'Satya Nadella','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015003','name' => 'Bill Gates','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015004','name' => 'Mark Zuckerberg','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015005','name' => 'Larry Page','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015006','name' => 'Sergey Brin','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015007','name' => 'Steve Jobs','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015008','name' => 'Steve Wozniak','type' => 'faculty','department' => 'CA','year' => 'faculty','password' => $password,'login_first_time'=>$login_first_time),
            #FY Students
            array('id'=>'CA2015009','name' => 'Johnny Depp','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015010','name' => 'Tom Cruise','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015011','name' => 'Hugh Jackman','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015012','name' => 'Vin Diesel','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015013','name' => 'Russell Crowe','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015014','name' => 'Russell Peters','type' => 'student','department' => 'CA','year' => 'fybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015015','name' => 'Brad Pitt','type' => 'student','department' => 'CA','year' => 'fymsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015016','name' => 'Brad Adams','type' => 'student','department' => 'CA','year' => 'fymsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015017','name' => 'Kevin Spacey','type' => 'student','department' => 'CA','year' => 'fymsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015018','name' => 'Robert Downey','type' => 'student','department' => 'CA','year' => 'fymsc','password' => $password,'login_first_time'=>$login_first_time),
            #SY Students
            array('id'=>'CA2015019','name' => 'Tom Hardy','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015020','name' => 'Simon Baker','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015021','name' => 'Denzel Washington','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015022','name' => 'Angelina Jolie','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015023','name' => 'Tom Riddle','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015024','name' => 'John Travolta','type' => 'student','department' => 'CA','year' => 'sybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015025','name' => 'Arnold Schwarzenegger','type' => 'student','department' => 'CA','year' => 'symsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015026','name' => 'Sylvester Stallone','type' => 'student','department' => 'CA','year' => 'symsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015027','name' => 'Christian Bale','type' => 'student','department' => 'CA','year' => 'symsc','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015028','name' => 'Morgan Freeman','type' => 'student','department' => 'CA','year' => 'symsc','password' => $password,'login_first_time'=>$login_first_time),
            #TY Students
            array('id'=>'CA2015029','name' => 'Edward Norton','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015030','name' => 'Bruce Willis','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015031','name' => 'Tom Hanks','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015032','name' => 'Will Smith','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015033','name' => 'Matt Damon','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015034','name' => 'George Clooney','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015035','name' => 'Leonardo DiCaprio','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015036','name' => 'Sandra Bullock','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015037','name' => 'Megan Fox','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time),
            array('id'=>'CA2015038','name' => 'Gerard Butler','type' => 'student','department' => 'CA','year' => 'tybca','password' => $password,'login_first_time'=>$login_first_time)
            ));
    }
}
