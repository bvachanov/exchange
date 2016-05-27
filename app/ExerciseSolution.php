<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ExerciseSolution extends Model {

	protected $fillable=['name', 'feedback',  'author_id', 'file_name', 'exercise_id'];

}
