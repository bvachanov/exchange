<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Request;
use App\User;
use App\AdditionalDataProfessors;
use App\AdditionalDataStudents;

class AdminController extends Controller {

    //admin middleware, add student, delete student, add teacher, delete teacher
    //all students, all teachers

    public function createProfessor() {
        return view('admin.registerProfessor');
    }

    public function storeProfessor(Requests\CreateProfessorRequest $request) {
        $user=User::create([
             'name'=>$request->input('name'),
             'email'=>$request->input('email'),
             'password'=>bcrypt($request->input('name')),
             'account_type'=>2,
         ]);
         AdditionalDataProfessors::create([
             'user_id'=>$user->id,
             'first_name'=>$request->input('first_name'),
             'last_name'=>$request->input('last_name'),
             'academic_title'=>$request->input('academic_title'),
         ]);
         return redirect()->back();
    }

    public function createStudent() {

        $locale = Session::get('locale');
        $nameLoc = 'name_' . $locale;
        $courses = DB::table('course_of_studies')->lists($nameLoc, 'id');
        return view('admin.registerStudent', compact('courses'));
    }

    public function storeStudent(Requests\CreateStudentRequest $request) {
         $user=User::create([
             'name'=>$request->input('name'),
             'email'=>$request->input('email'),
             'password'=>bcrypt($request->input('faculty_number')),
             'account_type'=>3,
         ]);
         AdditionalDataStudents::create([
             'user_id'=>$user->id,
             'first_name'=>$request->input('first_name'),
             'last_name'=>$request->input('last_name'),
             'year'=>$request->input('year'),
             'course_of_studies'=>$request->input('course_of_studies'),
             'faculty_number'=>$request->input('faculty_number'),
             'group_number'=>$request->input('academic_group'),
         ]);
         return redirect()->back();
    }

}
