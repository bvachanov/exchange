<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignmentToStudent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
    {
        //group_id, student_id
        Schema::create('assignment_to_student', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('assignment_id')->unsigned();
            $table->foreign('assignment_id')->references('id')
                    ->on('assignments')->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')
                    ->on('users')->onDelete('cascade');
            
 
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
       Schema::drop('assignment_to_student');
    }

}
