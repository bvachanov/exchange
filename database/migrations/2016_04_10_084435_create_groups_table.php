<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_bg');
            $table->string('name_en');
            $table->string('name_de');
            $table->integer('professor')->unsigned();
            $table->foreign('professor')->references('id')
                    ->on('users');
            $table->integer('discipline')->unsigned();
            $table->foreign('discipline')->references('id')
                    ->on('disciplines');
                //teacher, fach, 
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
        Schema::drop('groups');
    }
}
