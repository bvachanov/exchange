<?php

use Illuminate\Database\Seeder;

class DisciplinesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('disciplines')->delete();
        DB::table('disciplines')->insert([
            ['professor_id' => 2, 'name_bg' => 'Математика 1', 'name_de' => 'Mathematik 1', 'name_en' => 'Mathematik 1', 'course_of_studies'=>1],        
           
        ]);
    }

}
