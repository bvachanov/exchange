<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=['name', 'description',  'professor_id', 'course_id'];
}
