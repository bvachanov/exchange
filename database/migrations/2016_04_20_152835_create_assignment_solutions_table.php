<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentSolutionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignment_solutions', function(Blueprint $table)
		{
			$table->increments('id');
            //author, discipline, content, group, feedback, name
            $table->string('name', 255);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')
                    ->on('users');
            $table->integer('assignment_id')->unsigned();
            $table->foreign('assignment_id')->references('id')
                    ->on('assignments')->onDelete('cascade');
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
		Schema::drop('assignment_solutions');
	}

}
