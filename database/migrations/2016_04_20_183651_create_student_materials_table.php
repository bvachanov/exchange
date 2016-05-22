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
            $table->string('name');
            $table->integer('author')->unsigned();
            $table->foreign('author')->references('id')
                    ->on('users');
            $table->integer('discipline')->unsigned();
            $table->foreign('discipline')->references('id')
                    ->on('disciplines');
            $table->integer('group')->unsigned();
            $table->foreign('group')->references('id')
                    ->on('groups');
            $table->string('file_name'); //path to file on the disk
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
