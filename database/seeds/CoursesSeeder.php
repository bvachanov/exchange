<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('courses')->delete();
        DB::table('courses')->insert([
            ['professor_id' => 2, 'name' => 'Mathematik 1', 'language' => 'Deutsch',
                'description'=>'Obligatorischer Fach, keine Vorkenntnisse notwendig.','course_of_studies'=>1], 
            ['professor_id' => 2, 'name' => 'Mathematik 2', 'language' => 'Deutsch',
                'description'=>'Vorkenntnisse: Mathematik 1','course_of_studies'=>1],   
           
        ]);
    }

}
