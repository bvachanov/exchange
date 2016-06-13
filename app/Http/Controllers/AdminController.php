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
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function createProfessor() {
        return view('admin.registerProfessor');
    }

    public function storeProfessor(Requests\CreateProfessorRequest $request) {
        $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('name')),
                    'account_type' => 2,
        ]);
        AdditionalDataProfessors::create([
            'user_id' => $user->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'academic_title' => $request->input('academic_title'),
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
        $user = User::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('faculty_number')),
                    'account_type' => 3,
        ]);
        AdditionalDataStudents::create([
            'user_id' => $user->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'year' => $request->input('year'),
            'course_of_studies' => $request->input('course_of_studies'),
            'faculty_number' => $request->input('faculty_number'),
            'group_number' => $request->input('academic_group'),
        ]);
        return redirect()->back();
    }

    public function deleteUser($id) {
        $user = User::where('id', $id)->first();
        if ($user->account_type != 1) {
            $user->delete();
            Session::flash('flash_message', trans('translations.success'));
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
       // return redirect();
    }

    public function getAllStudents() {
        $studens = User::where('account_type', 3)->join('additional_data_students', 'additional_data_students.user_id', '=', 'users.id')
                        ->select('users.id', 'users.name', 'users.email', 'additional_data_students.first_name', 'additional_data_students.last_name', 'additional_data_students.faculty_number')->get();
        dd($studens);
    }

    public function getAllProfessors() {
      $professors = User::where('account_type', 2)->join('additional_data_professors', 'additional_data_professors.user_id', '=', 'users.id')
                        ->select('users.id', 'users.name', 'users.email', 'additional_data_professors.first_name', 'additional_data_professors.last_name', 'additional_data_professors.academic_title')->get();
        dd($professors);  
    }

}
