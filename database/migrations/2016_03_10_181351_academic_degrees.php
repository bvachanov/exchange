<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AcademicDegrees extends Migration
{
     public function up()
    {
        Schema::create('academic_degrees', function (Blueprint $table) {
            //ime + bakalavyr/magistyr
            $table->increments('id');          
            $table->string('name_bg', 255);
            $table->string('name_de', 255);
            $table->string('name_en', 255);          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('academic_degrees');
    }
}
