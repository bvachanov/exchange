<?php

use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('account_types')->delete();
        DB::table('account_types')->insert([
            ['number' => '1', 'name_bg' => 'Администратор', 'name_de' => 'Administrator', 'name_en' => 'Administrator'],
            ['number' => '2', 'name_bg' => 'Преподавател', 'name_de' => 'Lehrkraft', 'name_en' => 'Professor'],
            ['number' => '3', 'name_bg' => 'Студент', 'name_de' => 'Student', 'name_en' => 'Student']
        ]);
    }

}
