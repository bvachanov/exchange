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
            $table->string('name', 255);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')
                    ->on('users')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')
                    ->on('groups')->onDelete('cascade');
            $table->string('file_name', 1000); //path to file on the disk
             $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')
                    ->on('material_types');
            $table->boolean('is_public');
            $table->date('end_date')->nullable();
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
