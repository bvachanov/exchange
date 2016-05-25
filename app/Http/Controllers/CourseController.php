<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Course;
use App\User;
use Auth;
use DB;
use Session;

class CourseController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function showAll() {
        $courses = Course::join('additional_data_professors', 'courses.professor_id', '=', 'additional_data_professors.user_id')
                        ->join('course_of_studies', 'course_of_studies.id', '=', 'courses.course_of_studies')
                        ->join('academic_degrees', 'course_of_studies.academic_degree', '=', 'academic_degrees.id')
                        ->select('courses.id', 'language', 'name', 'description', 'academic_title', 'first_name', 'last_name', 'academic_degrees.name_bg as acad_bg', 'academic_degrees.name_de as acad_de', 'academic_degrees.name_en as acad_en', 'course_of_studies.name_bg', 'course_of_studies.name_de', 'course_of_studies.name_en')->get();
        return view('courses.all', compact('courses'));
    }

    public function show($id) {
        $course = Course::where('id', $id)->first();
        $professor = DB::table('additional_data_professors')->where('user_id', $course->professor_id)->first();
        $courseOfStudies = DB::table('course_of_studies')->where('id', $course->course_of_studies)->first();
        $degree = DB::table('academic_degrees')->where('id', $courseOfStudies->academic_degree)->first();

        return view('courses.show', compact('course', 'professor', 'degree', 'courseOfStudies'));
    }

    public function create() {
        if (Auth::user()->account_type == 1) {
            $professors = User::where('account_type', 2)->lists('name', 'id');
            $courses = DB::table('course_of_studies')->lists('name_bg', 'id');
            return view('courses.create', compact('professors', 'courses'));
        } else {
            Session::flash('flash_message_error', "You don't have a permission for this operation.");
            return redirect()->back();
        }
    }

    public function edit($id) {
        $course = Course::where('id', $id)->first();
        $courses = DB::table('course_of_studies')->lists('name_bg', 'id');
        $professors = User::where('account_type', 2)->lists('name', 'id');
        return view('courses.edit', compact('course', 'courses', 'professors'));
    }

    public function update($id, Requests\CreateCourseRequest $request) {
        $user = Auth::user();
        $course = Course::where('id', $id)->first();
        if ($user->account_type == 1) {
            $course->name = $request->input('name');
            $course->language = $request->input('language');
            $course->description = $request->input('description');
            $course->professor_id = $request->input('professor');
            $course->course_of_studies = $request->input('course_of_studies');
            $course->save();
        } else if ($user->id == $course->professor_id) {
            $course->description = $request->input('description');
            $course->save();
        } else {
            Session::flash('flash_message_error', "You don't have a permission for this operation.");
            return redirect()->back();
        }
        return redirect()->action('CourseController@showAll');
    }

    public function store(Requests\CreateCourseRequest $request) {
        Course::create([
            'name' => $request->input('name'),
            'language' => $request->input('language'),
            'description' => $request->input('description'),
            'professor_id' => $request->input('professor'),
            'course_of_studies' => $request->input('course_of_studies'),
        ]);
        return redirect()->action('CourseController@showAll');
    }

    public function delete($id) {
        if (Auth::user()->account_type == 1) {
            Course::where('id', $id)->delete();
            return redirect()->action('CourseController@showAll');
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

}
