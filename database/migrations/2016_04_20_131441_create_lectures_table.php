<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('lectures', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')
                    ->on('users')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')
                    ->on('groups')->onDelete('cascade');
            $table->string('file_name', 1000); //path to file on the disk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('lectures');
    }

}
