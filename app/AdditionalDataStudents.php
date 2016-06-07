<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalDataStudents extends Model {

	protected $table='additional_data_students';
        protected $fillable = ['user_id','first_name', 'last_name', 'year', 'course_of_studies', 'faculty_number', 'group_number'];

}
