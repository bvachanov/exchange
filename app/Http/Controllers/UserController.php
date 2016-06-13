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
use App\AssignmentToStudent;
use App\ExerciseToStudent;
use Session;
use Hash;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {
        $user = User::where('id', $id)->first();
        $locale=Session::get('locale');
        $nameLoc='name_'.$locale;
        $accountType = AccountType::where('id', $user->account_type)->pluck($nameLoc);
        $additionalData = '';
        $courseOfStudies = '';
        if ($user->account_type == 2) {
            $additionalData = DB::table('additional_data_professors')->
                            where('user_id', $id)->first();
        } else if ($user->account_type == 3) {
            $additionalData = DB::table('additional_data_students')->
                            where('user_id', $id)->first();
            $courseOfStudies = DB::table('course_of_studies')->where('id', $additionalData->course_of_studies)
                    ->pluck($nameLoc);
        }
        return view('users.show', compact('user', 'additionalData', 'accountType', 'courseOfStudies'));
    }

    public function showStudentUploads() {
        $id = Auth::id();
        $assignments = AssignmentSolution::where('author_id', $id)->get();
        $assignGroup = [];
        $assignTask = [];
        foreach ($assignments as $assignment) {
            $assignTask[$assignment->id] = Assignment::where('id', $assignment->assignment_id)->first();
            $assignGroup[$assignment->id] = Group::where('id', $assignTask[$assignment->id]->group_id)->first();
        }
        $exercises = ExerciseSolution::where('author_id', Auth::id())->get();
        $exGroup = [];
        $exTask = [];
        foreach ($exercises as $ex) {
            $exTask[$ex->id] = Exercise::where('id', $ex->exercise_id)->first();
            $exGroup[$ex->id] = Group::where('id', $exTask[$ex->id]->group_id)->first();
        }

        return view('users.myUploads', compact('assignments', 'exercises', 'assignTask', 'assignGroup', 'exTask', 'exGroup'));
    }

    public function showStudentUnresolvedTasks() {
        $id = Auth::id();
        $a = AssignmentToStudent::where('student_id', $id)->get();
        $assignGroup = [];
        $assignTask = [];
        $assignments=[];
        foreach ($a as $assignment) {
            if (AssignmentSolution::where('author_id', $id)->where('assignment_id', $assignment->id)->count() == 0) {
                $assignments=$a;
                $assignTask[$assignment->id] = Assignment::where('id', $assignment->assignment_id)->first();
                $assignGroup[$assignment->id] = Group::where('id', $assignTask[$assignment->id]->group_id)->first();
            }
        }
        $e = ExerciseToStudent::where('student_id', Auth::id())->get();
        $exGroup = [];
        $exTask = [];
        $exercises=[];
        foreach ($e as $ex) {
            if (ExerciseSolution::where('author_id', $id)->where('exercise_id', $ex->id)->count() == 0) {
                $exercises=$e;
                $exTask[$ex->id] = Exercise::where('id', $ex->exercise_id)->first();
                $exGroup[$ex->id] = Group::where('id', $exTask[$ex->id]->group_id)->first();
            }
        }
        return view('users.unresolved', compact('assignments', 'exercises', 'assignTask', 'assignGroup', 'exTask', 'exGroup'));
    }
    
    public function showChangePasswordView()
    {
        return view('users.password');
    }
    
    public function changePassword(Requests\ChangePasswordRequest $request)
    {
        $oldPassword=$request->input('old_password');
        $user=Auth::user();
        if(Hash::check($oldPassword, $user->password))
        {
            $user->password=  bcrypt($request->input('password'));
            $user->save();
            return redirect('/');
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

}
