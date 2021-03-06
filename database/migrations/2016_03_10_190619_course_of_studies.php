<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CourseOfStudies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::create('course_of_studies', function (Blueprint $table) {
            //ime + akademichna stepen
            $table->increments('id');          
            $table->string('name_bg', 255);
            $table->string('name_de', 255);
            $table->string('name_en', 255);
            $table->integer('academic_degree')->unsigned();
             $table->foreign('academic_degree')->references('id')
                    ->on('academic_degrees');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('course_of_studies');
    }
}
