<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=['name_bg', 'name_de', 'name_en', 'professor', 'discipline'];
}
