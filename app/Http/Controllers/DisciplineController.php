<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Discipline;
use App\User;
use Auth;
use DB;

class DisciplineController extends Controller {

    public function showAll() {
       $disciplines=  Discipline::join('additional_data_professors',
               'disciplines.professor_id', '=', 'additional_data_professors.user_id')
               ->join('course_of_studies', 'course_of_studies.id','=', 'disciplines.course_of_studies')
               ->join('academic_degrees', 'course_of_studies.academic_degree', '=', 'academic_degrees.id')
               ->select('disciplines.id', 'language', 'name', 'description', 'academic_title', 
                       'first_name', 'last_name', 'academic_degrees.name_bg as acad_bg', 'academic_degrees.name_de as acad_de',
                        'academic_degrees.name_en as acad_en','course_of_studies.name_bg','course_of_studies.name_de',
                       'course_of_studies.name_en')->get();
       return view('disciplines.all', compact('disciplines'));
       
    }

    public function show($id) {
        $discipline=  Discipline::where('id', $id)->first();
        $professor=DB::table('additional_data_professors')->where('user_id', $discipline->professor_id)->first();
        $course=DB::table('course_of_studies')->where('id', $discipline->course_of_studies)->first();
        $degree=DB::table('academic_degrees')->where('id', $course->academic_degree)->first();
        
        return view('disciplines.show', compact('discipline',  'professor', 'degree', 'course'));
    }

    public function create() {
        $professors=User::where('account_type', 2)->lists('name','id');
        $courses=DB::table('course_of_studies')->lists('name_bg','id');
         return view('disciplines.create', compact( 'professors',  'courses'));
    }
    
    public function edit($id) {
        $discipline=  Discipline::where('id', $id)->first();
        $this->checkIfOwnerOrAdmin($discipline);
        
    }

    public function store() {
        
    }

    private function checkIfOwnerOrAdmin($discipline) {
        $user = Auth::user();
        if ($user->account_type != 1 && $discipline->professor_id != $user->id) {
            //edit or store permission denied
            Session::flash('flash_message_error', "You don't have a permission for this operation.");
            return redirect()->back();
        }
        return true;
    }

}
