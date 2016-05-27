<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {
        protected $table='exercises';
	 protected $fillable=['name', 'group_id',  'author_id', 'file_name', 'end_date'];

}
