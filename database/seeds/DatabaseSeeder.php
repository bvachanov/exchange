<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
                $this->call('AcademicDegreesSeeder');
                $this->call('AccountTypeSeeder');
                $this->call('CourseOfStudiesSeeder');
                $this->call('MaterialTypeSeeder');
                $this->call('UserSeeder');
                $this->call('DisciplinesSeeder');
	}

}
