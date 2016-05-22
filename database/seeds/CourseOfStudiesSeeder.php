<?php

use Illuminate\Database\Seeder;

class CourseOfStudiesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('course_of_studies')->delete();
        DB::table('course_of_studies')->insert([
            ['id' => '1', 'name_bg' => 'КСТ', 'name_de' => 'Informatik', 'name_en' => 'Informatics', 'academic_degree'=>1],
            ['id' => '2', 'name_bg' => 'ОМ', 'name_de' => 'Maschinenbau', 'name_en' => 'Mechanical Engineering', 'academic_degree'=>1],
           
        ]);
    }

}
