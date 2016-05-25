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
                'description'=>'bla bla bla bla bla bla bla bla bla bla bla bla'
                . ' bla bla bla bla ','course_of_studies'=>1], 
            ['professor_id' => 2, 'name' => 'Mathematik 2', 'language' => 'Deutsch',
                'description'=>'bla2 bla2 bla bla bla bla bla bla bla bla bla bla'
                . ' bla bla bla bla ','course_of_studies'=>1],   
           
        ]);
    }

}
