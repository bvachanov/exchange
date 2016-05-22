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
            $table->string('name_bg');
            $table->string('name_de');
            $table->string('name_en');          
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
