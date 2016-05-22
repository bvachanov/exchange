<?php

use Illuminate\Database\Seeder;

class MaterialTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('material_types')->delete();
        DB::table('material_types')->insert([
            ['id' => '1', 'name_bg' => 'Описание', 'name_de' => 'Beschreibung', 'name_en' => 'Summary'],
            ['id' => '2', 'name_bg' => 'Лекция', 'name_de' => 'Vorlesung', 'name_en' => 'Lecture'],
            ['id' => '3', 'name_bg' => 'Упражнение', 'name_de' => 'Übung', 'name_en' => 'Exercise'],
            ['id' => '4', 'name_bg' => 'Задача', 'name_de' => 'Aufgabe', 'name_en' => 'Assignment']
        ]);
    }

}
