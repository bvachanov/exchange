<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExerciseSolutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exercise_solutions', function(Blueprint $table)
		{
			$table->increments('id');
            //author, discipline, content, group, feedback, name
            $table->string('name', 255);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')
                    ->on('users');
            $table->integer('group_id')->unsigned();
            $table->integer('exercise_id')->unsigned();
            $table->foreign('exercise_id')->references('id')
                    ->on('exercises')->onDelete('cascade');
            $table->string('file_name', 1000); //path to file on the disk
            $table->text('feedback');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exercise_solutions');
	}

}
