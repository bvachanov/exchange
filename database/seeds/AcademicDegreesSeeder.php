<?php

use Illuminate\Database\Seeder;

class AcademicDegreesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('academic_degrees')->delete();
        DB::table('academic_degrees')->insert([
            ['id' => '1', 'name_bg' => 'Бакалавър', 'name_de' => 'Bachelor', 'name_en' => 'Bachelor'],
            ['id' => '2', 'name_bg' => 'Магистър', 'name_de' => 'Master', 'name_en' => 'Master'],
           
        ]);
    }

}
