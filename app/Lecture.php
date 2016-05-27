<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model {

	 protected $fillable=['name', 'group_id',  'author_id', 'file_name'];

}
