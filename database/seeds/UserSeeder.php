<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->delete();
        DB::table('additional_data_students')->delete();
        DB::table('additional_data_professors')->delete();
        DB::table('users')->insert([
            ['name' => 'admin', 'email' => 'admin@fdiba.bg', 'password' => bcrypt('123456'), 'account_type' => 1],
            ['name' => 'teacher', 'email' => 'teacher@fdiba.bg', 'password' => bcrypt('123456'), 'account_type' => 2],
            ['name' => 'student', 'email' => 'student@fdiba.bg', 'password' => bcrypt('123456'), 'account_type' => 3],
        ]);
         DB::table('additional_data_students')->insert([
             ['user_id'=>3, 'first_name'=>'Student', 'last_name'=>"studentov",
                 'faculty_number'=>201212013, 'group_number'=>88, 'year'=>2012,
                 'course_of_studies'=>1],
         ]);
         DB::table('additional_data_professors')->insert([
             ['user_id'=>2, 'first_name'=>'Daakal', 'last_name'=>"daskalov",
                 'academic_title'=>'Dozent'],
         ]);
    }

}
