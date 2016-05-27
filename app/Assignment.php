<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {

	 protected $fillable=['name', 'group_id',  'author_id', 'file_name', 'end_date'];

}
