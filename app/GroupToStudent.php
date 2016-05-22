<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupToStudent extends Model
{
    protected $table='group_to_student';
    protected $fillable=['group_id',  'student_id'];
}
