<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_materials', function (Blueprint $table) {
            $table->increments('id');
            //author, discipline, content, group, feedback, name
            $table->string('name', 255);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')
                    ->on('users');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')
                    ->on('groups')->onDelete('cascade');
            $table->integer('assignment_id')->unsigned();
            $table->foreign('assignment_id')->references('id')
                    ->on('professor_materials')->onDelete('cascade');
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
        Schema::drop('student_materials');
    }
}
