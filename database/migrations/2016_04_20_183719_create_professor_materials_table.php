<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professor_materials', function (Blueprint $table) {
            $table->increments('id');
            //author, content, type, group, is_public, discipline
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
             $table->integer('type')->unsigned();
            $table->foreign('type')->references('id')
                    ->on('disciplines');
            $table->boolean('is_public');
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
        Schema::drop('professor_materials');
    }
}
