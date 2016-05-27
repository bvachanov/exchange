<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use DB;
use App\AccountType;
use App\AssignmentSolution;
use App\ExerciseSolution;
use App\Exercise;
use App\Assignment;
use App\Group;
use Auth;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {
        $user = User::where('id', $id)->first();
        $accountType = AccountType::where('id', $user->account_type)->pluck('name_bg');
        $additionalData = '';
        $courseOfStudies = '';
        if ($user->account_type == 2) {
            $additionalData = DB::table('additional_data_professors')->
                            where('user_id', $id)->first();
        } else if ($user->account_type == 3) {
            $additionalData = DB::table('additional_data_students')->
                            where('user_id', $id)->first();
            $courseOfStudies = DB::table('course_of_studies')->where('id', $additionalData->course_of_studies)
                    ->pluck('name_bg');
        }
        return view('users.show', compact('user', 'additionalData', 'accountType', 'courseOfStudies'));
    }
    
    public function showStudentUploads()
    {
        $id=Auth::id();
        $assignments=  AssignmentSolution::where('author_id', $id)->get();
        $assignGroup=[];
        $assignTask=[];        
        foreach ($assignments as $assignment)
        {
            $assignTask[$assignment->id]=Assignment::where('id', $assignment->assignment_id)->first();
            $assignGroup[$assignment->id]=  Group::where('id', $assignTask[$assignment->id]->group_id)->first();
        }
        $exercises=  ExerciseSolution::where('author_id', Auth::id())->get();
        $exGroup=[];
        $exTask=[];
        foreach ($exercises as $ex)
        {
            $exGroup[$ex->id]=Assignment::where('id', $ex->exercise_id)->first();
            $exTask[$ex->id]=  Group::where('id', $exGroup[$ex->id]->group_id)->first();
        }
        
        return view('users.myGroups', compact('assignments', 'exercises', 'assignTask', 'assignGroup', 'exTask', 'exGroup'));
        
    }

}
