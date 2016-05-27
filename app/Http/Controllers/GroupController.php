<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use App\Group;
use Auth;
use App\Course;
use App\GroupToStudent;
use DB;
use App\MaterialType;
use Storage;
use Input;
use App\ProfessorMaterial;
use App\AssignmentToStudent;
use Carbon\Carbon;
use Session;
use App\Lecture;
use App\Assignment;
use App\Exercise;
use App\ExerciseToStudent;
use App\AssignmentSolution;
use App\ExerciseSolution;

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getGroups() {
        $id = Auth::id();
        $groups = Group::join('group_to_student', 'groups.id','=','group_to_student.group_id')
                ->where('student_id', $id)->get();
        $courses=[];
        $professors=[];
        foreach ($groups as $group)
        {
            $courses[$group->id]=DB::table('courses')->where('id', $group->course_id)->first();
            $professors[$group->id]=DB::table('additional_data_professors')->where('user_id', $group->professor_id)->first();
        }
        return view('groups.showGroupsStudent', compact('groups', 'professors', 'courses'));
    }

    public function showGroup($id) {
        $assignedToGroup = GroupToStudent::where('student_id', Auth::id())
                        ->where('group_id', $id)->count();
        if ($assignedToGroup > 0) {
            $group = Group::where('id', $id)->first();
            $professor = DB::table('additional_data_professors')->where('user_id', $group->professor_id)->first();
            $discipline = Course::where('id', $group->course_id)->first();
            $lectures = DB::table('lectures')->where('group_id', $id)->get();
            $exercises = DB::table('exercises')->where('group_id', $id)
                            ->join('exercise_to_student', 'exercise_to_student.exercise_id', '=', 'exercises.id')
                            ->where('student_id', Auth::id())->select('exercises.id', 'exercises.created_at', 'name', 'end_date')->get();
            $assignments = DB::table('assignments')->where('group_id', $id)
                            ->join('assignment_to_student', 'assignment_to_student.assignment_id', '=', 'assignments.id')
                            ->where('student_id', Auth::id())->select('assignments.id', 'assignments.created_at', 'name', 'end_date')->get();
            $others = DB::table('professor_materials')->where('group_id', $id)->get();
            return view('groups.showGroupUser', compact('group', 'lectures', 'exercises', 'discipline', 'assignments', 'others', 'professor'));
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function downloadLecture($id) {
        $file = Lecture::where('id', $id)->first();
        return response()->download(base_path() . $file->file_name);
    }

    public function downloadExercise($id) {
        $file = Exercise::where('id', $id)->first();
        return response()->download(base_path() . $file->file_name);
    }

    public function downloadAssignment($id) {
        $file = Assignment::where('id', $id)->first();
        return response()->download(base_path() . $file->file_name);
    }

    public function downloadOther($id) {
        $file = ProfessorMaterial::where('id', $id)->first();
        return response()->download(base_path() . $file->file_name);
    }

    public function downloadAssignmentSolution($id) {
        $isAuthor = AssignmentSolution::where('author_id', Auth::id())->count();
        if ($isAuthor > 0 || Auth::user()->account_type == 2) {
            $file = AssignmentSolution::where('id', $id)->first();
            return response()->download(base_path() . $file->file_name);
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }
    
    public function deleteAssignmentSolution($id) {
        $file = AssignmentSolution::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function showAssignment($id) {
        $assignedTo = AssignmentToStudent::where('assignment_id', $id)->where('student_id', Auth::id())->count();
        if ($assignedTo > 0) {
            $assignment = Assignment::where('id', $id)->first();
            $solutions = AssignmentSolution::where('assignment_id', $id)
                            ->where('author_id', Auth::id())->get();
            return view('assignments.showAssignmentUser', compact('assignment', 'solutions'));
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function uploadAssignment($id, Requests\UploadAssignmentRequest $request) {

        $assignedTo = AssignmentToStudent::where('assignment_id', $id)->where('student_id', Auth::id())->count();
        if ($assignedTo > 0) {
            $assignment = Assignment::where('id', $id)->first();
            $name = $assignment->name . DB::table('additional_data_students')
                            ->where('user_id', Auth::id())->pluck('faculty_number');
            $extension = Input::file('file')->getClientOriginalExtension();
            $path = '/storage/app/fileStorage/group_' . $assignment->group_id . '_dir/';
            $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
            Request::file('file')->move(base_path() . $path, $fileName);
            AssignmentSolution::create([
                'name' => $name,
                'author_id' => Auth::id(),
                'assignment_id' => $assignment->id,
                'file_name' => $path . $fileName,
                'feedback' => '',
            ]);
            return redirect()->back();
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }
    
    public function downloadExerciseSolution($id) {
        $isAuthor = ExerciseSolution::where('author_id', Auth::id())->count();
        if ($isAuthor > 0 || Auth::user()->account_type == 2) {
            $file = ExerciseSolution::where('id', $id)->first();
            return response()->download(base_path() . $file->file_name);
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }
    
    public function deleteExerciseSolution($id) {
        $file = ExerciseSolution::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function showExercise($id) {
        $assignedTo = ExerciseToStudent::where('exercise_id', $id)->where('student_id', Auth::id())->count();
        if ($assignedTo > 0) {
            $exercise = Exercise::where('id', $id)->first();
            $solutions = ExerciseSolution::where('exercise_id', $id)
                            ->where('author_id', Auth::id())->get();
            return view('exercises.showExerciseUser', compact('exercise', 'solutions'));
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function uploadExercise($id, Requests\UploadAssignmentRequest $request) {

        $assignedTo = ExerciseToStudent::where('exercise_id', $id)->where('student_id', Auth::id())->count();
        if ($assignedTo > 0) {
            $exercise = Exercise::where('id', $id)->first();
            $name = $exercise->name . DB::table('additional_data_students')
                            ->where('user_id', Auth::id())->pluck('faculty_number');
            $extension = Input::file('file')->getClientOriginalExtension();
            $path = '/storage/app/fileStorage/group_' . $exercise->group_id . '_dir/';
            $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
            Request::file('file')->move(base_path() . $path, $fileName);
            ExerciseSolution::create([
                'name' => $name,
                'author_id' => Auth::id(),
                'exercise_id' => $exercise->id,
                'file_name' => $path . $fileName,
                'feedback' => '',
            ]);
            return redirect()->back();
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

}
