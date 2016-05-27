<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseToStudent extends Model {
    protected $table='exercise_to_student';
	 protected $fillable=['exercise_id',  'student_id'];

}
