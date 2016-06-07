<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalDataProfessors extends Model {

	protected $table='additional_data_professors';
         protected $fillable = ['user_id','first_name', 'last_name', 'academic_title'];
}
