<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddtionalDataStudents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('additional_data_students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('faculty_number');
            //zavisqt ot grupata
//            $table->integer('year');
//            $table->integer('course_of_studies')->unsigned();
//             $table->foreign('course_of_studies')->references('id')
//                    ->on('course_of_studies');          
            $table->integer('group_number');
            $table->integer('year');
            $table->integer('course_of_studies')->unsigned();
            $table->foreign('course_of_studies')->references('id')
                    ->on('course_of_studies');
            //course_of_studies table pri accounts, tablica s grupite, bachelor/master
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('additional_data_students');
    }

}
