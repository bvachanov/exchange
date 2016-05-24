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
            ['name' => 'student1', 'email' => 'student1@fdiba.bg', 'password' => bcrypt('123456'), 'account_type' => 3],
             ['name' => 'student2', 'email' => 'student2@fdiba.bg', 'password' => bcrypt('123456'), 'account_type' => 3],
        ]);
         DB::table('additional_data_students')->insert([
             ['user_id'=>3, 'first_name'=>'Student1', 'last_name'=>"studentov1",
                 'faculty_number'=>201212013, 'group_number'=>88, 'year'=>2012,
                 'course_of_studies'=>1],
             ['user_id'=>4, 'first_name'=>'Student2', 'last_name'=>"studentov2",
                 'faculty_number'=>201212014, 'group_number'=>88, 'year'=>2012,
                 'course_of_studies'=>1],
         ]);
         DB::table('additional_data_professors')->insert([
             ['user_id'=>2, 'first_name'=>'Daakal', 'last_name'=>"daskalov",
                 'academic_title'=>'Dozent'],
         ]);
    }

}
