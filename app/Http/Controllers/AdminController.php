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
use App\ExerciseSolution;
use App\AssignmentSolution;
use App\Group;
use Storage;
use App\Course;

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
        if ($user->account_type == 3) {
            $this->deleteFilesStudent($id);
            $user->delete();
            Session::flash('flash_message', trans('translations.success'));
        } else if ($user->account_type == 2) {
            $this->deleteFilesProfessor($id);
            $this->removeProfessorFromCourse($id);
            $user->delete();
        } else {
            Session::flash('flash_message_error', trans('translations.notAllowed'));
        }
        return redirect()->back();
    }

    private function deleteFilesStudent($id) {
        $filesA = AssignmentSolution::where('author_id', $id)->get();
        foreach ($filesA as $file) {
            unlink(base_path() . $file->file_name);
            $file->delete();
        }
        $filesE = ExerciseSolution::where('author_id', $id)->get();
        foreach ($filesE as $file) {
            unlink(base_path() . $file->file_name);
            $file->delete();
        }
    }

    private function removeProfessorFromCourse($id) {
        $courses = Course::where('professor_id', $id)->get();
        foreach ($courses as $c) {
            $c->professor_id = null;
            $c->save();
        }
    }

    private function deleteFilesProfessor($id) {
        $groups = Group::where('professor_id', $id)->get();
        foreach ($groups as $group) {
            $path = '/fileStorage/group_' . $group->id . '_dir';
            Storage::disk('local')->deleteDirectory($path);
        }
    }

    public function getAllStudents() {
        $students = User::where('account_type', 3)->join('additional_data_students', 'additional_data_students.user_id', '=', 'users.id')
                        ->select('users.id', 'users.name', 'users.email', 'additional_data_students.first_name', 'additional_data_students.last_name', 'additional_data_students.faculty_number')->get();
        return view('admin.allStudents', compact('students'));
    }

    public function getAllProfessors() {
        $professors = User::where('account_type', 2)->join('additional_data_professors', 'additional_data_professors.user_id', '=', 'users.id')
                        ->select('users.id', 'users.name', 'users.email', 'additional_data_professors.first_name', 'additional_data_professors.last_name', 'additional_data_professors.academic_title')->get();
        return view('admin.allProfessors', compact('professors'));
    }

}
