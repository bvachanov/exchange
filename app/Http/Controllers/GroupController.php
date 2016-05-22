<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use App\Group;
use Auth;
use App\Discipline;
use App\GroupToStudent;


class GroupController extends Controller
{
    public function createGroup()
    {
        $users= User::where('account_type', 3)->get(); 
        $disciplines=  Discipline::all()->lists('name_de', 'id');
        return view('groups.addGroup', compact('users', 'disciplines'));
    }
    
    public function storeGroup()
    {
        $group=Group::create([
            'name_bg'=>Request::input('name_bg'),
            'name_en'=>Request::input('name_en'),
            'name_de'=>Request::input('name_de'),
            'professor'=>Auth::id(),
            'discipline'=>Request::input('discipline'),
        ]);
        
        $students=Request::input('students');
        foreach ($students as $student)
        {
            GroupToStudent::create([
                'group_id'=>$group->id,
                'student_id'=>$student,
                ]);
        }
        
        return view('groups.showGroup', compact('group'));
        
    }
}
