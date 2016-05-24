<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentToStudent extends Model {

	    protected $table='assignment_to_student';
    protected $fillable=['assignment_id',  'student_id'];

}
