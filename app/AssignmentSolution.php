<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSolution extends Model {

	protected $fillable=['name', 'feedback',  'author_id', 'file_name', 'assignment_id'];

}
