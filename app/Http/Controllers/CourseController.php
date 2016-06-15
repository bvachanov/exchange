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
        $locale = Session::get('locale');
        $nameLoc = 'name_' . $locale;
        $courses = Course::leftJoin('additional_data_professors', 'courses.professor_id', '=', 'additional_data_professors.user_id')
                        ->join('course_of_studies', 'course_of_studies.id', '=', 'courses.course_of_studies')
                        ->join('academic_degrees', 'course_of_studies.academic_degree', '=', 'academic_degrees.id')
                        ->select('courses.id', 'language', 'name', 'description', 'academic_title','user_id', 'first_name', 'last_name', 'academic_degrees.' . $nameLoc . ' as acad', 'course_of_studies.' . $nameLoc . ' as course_name')->get();
        return view('courses.all', compact('courses'));
    }

    public function show($id) {
        $course = Course::where('id', $id)->first();
        $locale = Session::get('locale');
        $nameLoc = 'name_' . $locale;
        $professor = DB::table('additional_data_professors')->where('user_id', $course->professor_id)->first();
        $courseOfStudies = DB::table('course_of_studies')->where('id', $course->course_of_studies)->select('id', $nameLoc . ' as name', 'academic_degree')->first();
        $degree = DB::table('academic_degrees')->where('id', $courseOfStudies->academic_degree)->select('id', $nameLoc . ' as name')->first();

        return view('courses.show', compact('course', 'professor', 'degree', 'courseOfStudies'));
    }

    public function create() {
        if (Auth::user()->account_type == 1) {
            $locale = Session::get('locale');
            $nameLoc = 'name_' . $locale;
            $courses = DB::table('course_of_studies')->lists($nameLoc, 'id');
            $professors = [];
            $profs = User::where('account_type', 2)
                            ->join('additional_data_professors', 'users.id', '=', 'additional_data_professors.user_id')
                            ->select('additional_data_professors.first_name', 'additional_data_professors.last_name', 'additional_data_professors.academic_title', 'users.id')->get();
            foreach ($profs as $p) {
                $professors[$p->id] = $p->academic_title . " " . $p->first_name . ' ' . $p->last_name;
            }
            return view('courses.create', compact('professors', 'courses'));
        } else {
            Session::flash('flash_message_error', trans('translations.notAllowed'));
            return redirect()->back();
        }
    }

    public function edit($id) {
        $course = Course::where('id', $id)->first();
        $locale = Session::get('locale');
        $nameLoc = 'name_' . $locale;
        $courses = DB::table('course_of_studies')->lists($nameLoc, 'id');
        $professors = [];
        $profs = User::where('account_type', 2)
                        ->join('additional_data_professors', 'users.id', '=', 'additional_data_professors.user_id')
                        ->select('additional_data_professors.first_name', 'additional_data_professors.last_name', 'additional_data_professors.academic_title', 'users.id')->get();
        foreach ($profs as $p) {
            $professors[$p->id] = $p->academic_title . " " . $p->first_name . ' ' . $p->last_name;
        }
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
            Session::flash('flash_message_error', trans('translations.notAllowed'));
            return redirect()->back();
        }
        return redirect()->action('CourseController@showAll');
    }

    public function store(Requests\CreateCourseRequest $request) {
        $user = Auth::user();
        if ($user->account_type == 1) {
            Course::create([
                'name' => $request->input('name'),
                'language' => $request->input('language'),
                'description' => $request->input('description'),
                'professor_id' => $request->input('professor'),
                'course_of_studies' => $request->input('course_of_studies'),
            ]);
            return redirect()->action('CourseController@showAll');
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function delete($id) {
        if (Auth::user()->account_type == 1) {
            Course::where('id', $id)->delete();
            return redirect()->action('CourseController@showAll');
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

}
